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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#10b981'); // Hex color for UI
            $table->string('icon')->nullable(); // FontAwesome icon class
            $table->string('image')->nullable(); // Category image
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            // SEO fields
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();

            // Statistics
            $table->integer('posts_count')->default(0);

            $table->timestamps();

            // Indexes
            $table->index(['is_active', 'sort_order']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};