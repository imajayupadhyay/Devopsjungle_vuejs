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
        Schema::create('exam_faqs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_dump_id')->nullable()->constrained()->onDelete('cascade'); // null means global FAQ
            $table->text('question');
            $table->text('answer');
            $table->boolean('is_global')->default(false); // Global FAQs shown on all exams
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexes
            $table->index(['exam_dump_id', 'is_active']);
            $table->index(['is_global', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_faqs');
    }
};
