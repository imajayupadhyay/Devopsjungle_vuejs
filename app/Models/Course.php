<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'course_category_id',
        'description',
        'full_description',
        'instructor',
        'level',
        'duration',
        'lessons',
        'language',
        'price',
        'original_price',
        'certificate',
        'bestseller',
        'featured',
        'students',
        'rating',
        'reviews',
        'views',
        'skills',
        'prerequisites',
        'target_audience',
        'what_you_learn',
        'curriculum',
        'status',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at',
        'last_updated',
    ];

    protected $casts = [
        'certificate' => 'boolean',
        'bestseller' => 'boolean',
        'featured' => 'boolean',
        'skills' => 'array',
        'prerequisites' => 'array',
        'target_audience' => 'array',
        'what_you_learn' => 'array',
        'curriculum' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'rating' => 'decimal:1',
        'published_at' => 'datetime',
        'last_updated' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected $attributes = [
        'rating' => 0.0,
        'reviews' => 0,
        'students' => 0,
        'views' => 0,
        'certificate' => true,
        'bestseller' => false,
        'featured' => false,
        'level' => 'intermediate',
        'language' => 'English',
        'price' => 0.00,
        'status' => 'draft',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
        });
    }

    /**
     * Scope for published courses
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for draft courses
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope for featured courses
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for bestseller courses
     */
    public function scopeBestseller($query)
    {
        return $query->where('bestseller', true);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('instructor', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%");
        });
    }

    /**
     * Get the category that owns the course
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    /**
     * Scope for filtering by category
     */
    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('course_category_id', $categoryId);
    }

    /**
     * Scope for filtering by level
     */
    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Publish the course
     */
    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    /**
     * Unpublish the course
     */
    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
        ]);
    }

    /**
     * Increment view count
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Increment students count
     */
    public function incrementStudents()
    {
        $this->increment('students');
    }

    /**
     * Get discount percentage
     */
    public function getDiscountPercentageAttribute()
    {
        if ($this->original_price && $this->original_price > 0) {
            return round((1 - $this->price / $this->original_price) * 100);
        }
        return 0;
    }

    /**
     * Check if course has discount
     */
    public function hasDiscount()
    {
        return $this->original_price && $this->original_price > $this->price;
    }
}
