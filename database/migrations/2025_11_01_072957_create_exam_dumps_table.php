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
        Schema::create('exam_dumps', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('title'); // AWS Certified Solutions Architect - Associate
            $table->string('code')->unique(); // SAA-C03
            $table->string('slug')->unique(); // aws-saa-c03
            $table->text('description');
            $table->longText('full_description')->nullable(); // Detailed description for detail page

            // Provider
            $table->foreignId('exam_provider_id')->constrained()->onDelete('cascade');

            // Difficulty
            $table->enum('difficulty', ['beginner', 'intermediate', 'expert'])->default('intermediate');

            // Exam Details
            $table->integer('questions_count'); // Number of questions
            $table->integer('duration_minutes'); // Exam duration
            $table->integer('passing_score'); // Minimum score to pass

            // Pricing
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('original_price', 10, 2)->nullable(); // For showing discounts
            $table->boolean('is_free')->default(false);

            // Statistics
            $table->integer('success_rate')->default(0); // Percentage
            $table->integer('popularity')->default(0); // 0-100
            $table->integer('downloads')->default(0);
            $table->integer('views')->default(0);

            // Status
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->boolean('featured')->default(false);
            $table->string('badge')->nullable(); // Most Popular, High Demand, Entry Level, Hands-on

            // Content Files
            $table->string('pdf_file')->nullable(); // Path to PDF file
            $table->string('sample_pdf')->nullable(); // Path to sample PDF
            $table->json('additional_files')->nullable(); // Additional resources

            // Metadata
            $table->json('prerequisites')->nullable(); // Array of prerequisites
            $table->json('target_audience')->nullable(); // Array of target audience
            $table->json('what_you_learn')->nullable(); // Array of learning outcomes

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Dates
            $table->timestamp('published_at')->nullable();
            $table->timestamp('last_updated_at')->nullable(); // When content was last updated
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['exam_provider_id', 'status']);
            $table->index(['difficulty', 'status']);
            $table->index(['featured', 'status']);
            $table->index(['is_free', 'status']);
            $table->index(['slug']);
            $table->index(['code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_dumps');
    }
};
