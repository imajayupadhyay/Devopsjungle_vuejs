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
        Schema::create('course_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Amazon AWS, Docker, Kubernetes, etc.
            $table->string('slug')->unique(); // aws, docker, kubernetes
            $table->string('icon')->nullable(); // fab fa-aws, fab fa-docker, etc.
            $table->text('description')->nullable();
            $table->string('color')->nullable(); // For UI display
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            // Indexes
            $table->index(['slug', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_categories');
    }
};
