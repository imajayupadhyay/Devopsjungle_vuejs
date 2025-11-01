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
        Schema::create('exam_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Amazon AWS, Microsoft Azure, Google Cloud, etc.
            $table->string('slug')->unique(); // aws, azure, gcp, kubernetes, docker
            $table->string('icon')->nullable(); // fab fa-aws, fab fa-microsoft, etc.
            $table->text('description')->nullable();
            $table->string('gradient_color')->nullable(); // For card backgrounds
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
        Schema::dropIfExists('exam_providers');
    }
};
