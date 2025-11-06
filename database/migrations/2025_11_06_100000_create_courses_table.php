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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('title'); // Complete AWS Cloud Practitioner & Solutions Architect
            $table->string('slug')->unique(); // aws-complete-guide
            $table->string('category'); // aws, azure, terraform, linux, jenkins, docker, kubernetes, etc.
            $table->text('description'); // Short description for cards
            $table->longText('full_description')->nullable(); // Detailed description for detail page

            // Instructor
            $table->string('instructor'); // John Mitchell, AWS Solutions Architect

            // Level/Difficulty
            $table->enum('level', ['beginner', 'intermediate', 'advanced', 'expert'])->default('intermediate');

            // Course Details
            $table->integer('duration'); // Total hours (e.g., 45)
            $table->integer('lessons'); // Number of lessons (e.g., 120)
            $table->string('language')->default('English');

            // Pricing
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('original_price', 10, 2)->nullable(); // For showing discounts

            // Features
            $table->boolean('certificate')->default(true);
            $table->boolean('bestseller')->default(false);
            $table->boolean('featured')->default(false);

            // Statistics
            $table->integer('students')->default(0); // Enrolled students count
            $table->decimal('rating', 3, 1)->default(0.0); // e.g., 4.9
            $table->integer('reviews')->default(0); // Review count
            $table->integer('views')->default(0); // View count

            // Content
            $table->json('skills')->nullable(); // Array of skills: ['EC2', 'S3', 'RDS', 'Lambda']
            $table->json('prerequisites')->nullable(); // Array of prerequisites
            $table->json('target_audience')->nullable(); // Array of target audience
            $table->json('what_you_learn')->nullable(); // Array of learning outcomes
            $table->json('curriculum')->nullable(); // Course curriculum/modules

            // Status
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Dates
            $table->timestamp('published_at')->nullable();
            $table->timestamp('last_updated')->nullable(); // When content was last updated
            $table->timestamps();
            $table->softDeletes();

            // Indexes for performance
            $table->index(['category', 'status']);
            $table->index(['level', 'status']);
            $table->index(['featured', 'status']);
            $table->index(['bestseller', 'status']);
            $table->index(['slug']);
            $table->index(['rating']);
            $table->index(['students']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
