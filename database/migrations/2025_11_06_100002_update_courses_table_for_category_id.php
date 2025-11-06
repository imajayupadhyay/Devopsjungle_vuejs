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
        Schema::table('courses', function (Blueprint $table) {
            // Drop the old category column if it exists
            if (Schema::hasColumn('courses', 'category')) {
                $table->dropColumn('category');
            }

            // Add the new category_id foreign key
            $table->foreignId('course_category_id')->nullable()->after('slug')->constrained('course_categories')->onDelete('set null');
            $table->index('course_category_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['course_category_id']);
            $table->dropColumn('course_category_id');

            // Restore the old category column
            $table->string('category', 100)->nullable()->after('slug');
        });
    }
};
