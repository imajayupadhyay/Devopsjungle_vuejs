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
        Schema::create('exam_dump_topic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_dump_id')->constrained()->onDelete('cascade');
            $table->foreignId('exam_topic_id')->constrained()->onDelete('cascade');
            $table->integer('coverage_percentage')->default(0); // Specific coverage for this exam
            $table->timestamps();

            // Unique constraint to prevent duplicates
            $table->unique(['exam_dump_id', 'exam_topic_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_dump_topic');
    }
};
