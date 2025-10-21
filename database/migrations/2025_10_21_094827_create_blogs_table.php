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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('featured_image')->nullable();
            $table->json('gallery_images')->nullable(); // For additional images

            // Author information
            $table->string('author_name');
            $table->string('author_avatar')->nullable();
            $table->string('author_role')->nullable();
            $table->text('author_bio')->nullable();

            // SEO fields
            $table->string('meta_title', 70)->nullable();
            $table->text('meta_description')->nullable(); // Up to 160 chars recommended
            $table->text('meta_keywords')->nullable();
            $table->string('canonical_url')->nullable();
            $table->json('social_meta')->nullable(); // Open Graph and Twitter meta

            // Categorization
            $table->string('category');
            $table->json('tags')->nullable();

            // Publishing
            $table->enum('status', ['draft', 'published', 'scheduled', 'archived'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('scheduled_at')->nullable();

            // Metrics
            $table->integer('views')->default(0);
            $table->integer('read_time')->default(0); // in minutes
            $table->boolean('featured')->default(false);

            // WordPress-like features
            $table->string('password')->nullable(); // For password protected posts
            $table->enum('comment_status', ['open', 'closed'])->default('open');
            $table->boolean('ping_status')->default(true); // For pingbacks/trackbacks
            $table->boolean('sticky')->default(false); // Sticky posts

            // Revision system
            $table->unsignedBigInteger('parent_id')->nullable(); // For revisions
            $table->foreign('parent_id')->references('id')->on('blogs')->onDelete('cascade');

            $table->timestamps();

            // Indexes for performance
            $table->index(['status', 'published_at']);
            $table->index(['category']);
            $table->index(['featured']);
            $table->index(['slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};