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
        Schema::create('exam_reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_dump_id')->constrained()->onDelete('cascade');
            $table->string('reviewer_name');
            $table->string('reviewer_initials', 5);
            $table->string('reviewer_role')->nullable();
            $table->integer('rating'); // 1-5
            $table->string('title');
            $table->text('content');
            $table->boolean('verified_purchase')->default(false);
            $table->integer('helpful_count')->default(0);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            // Indexes
            $table->index(['exam_dump_id', 'is_approved']);
            $table->index(['rating']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_reviews');
    }
};
