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
        Schema::create('exam_topics', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Compute, Storage, Database, etc.
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->integer('percentage')->default(0); // Percentage of exam coverage
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('exam_topics');
    }
};
