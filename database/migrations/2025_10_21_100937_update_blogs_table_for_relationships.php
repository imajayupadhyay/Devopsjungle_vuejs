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
        Schema::table('blogs', function (Blueprint $table) {
            // Remove the old category and tags columns
            $table->dropColumn(['category', 'tags']);

            // Add foreign key for category
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');

            // Add index for better performance
            $table->index('category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blogs', function (Blueprint $table) {
            // Remove foreign key and column
            $table->dropForeign(['category_id']);
            $table->dropIndex(['category_id']);
            $table->dropColumn('category_id');

            // Restore old columns
            $table->string('category');
            $table->json('tags')->nullable();
        });
    }
};