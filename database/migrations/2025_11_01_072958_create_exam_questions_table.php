<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_dump_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_topic_id')->nullable()->constrained()->onDelete('set null');
            $table->text('question'); // The question text
            $table->json('options'); // Array of options [A, B, C, D]
            $table->integer('correct_answer_index'); // Index of correct answer (0-3)
            $table->text('explanation'); // Explanation for the correct answer
            $table->json('references')->nullable(); // Links to documentation
            $table->boolean('is_sample')->default(false); // Is this a sample question for preview?
            $table->integer('difficulty_level')->default(1); // 1-5
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Indexes
            $table->index(['exam_dump_id', 'is_sample']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_questions');
    }
};
