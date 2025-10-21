<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'image',
        'is_active',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'posts_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'posts_count' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = $category->generateUniqueSlug($category->name);
            }

            if (empty($category->meta_title)) {
                $category->meta_title = Str::limit($category->name, 65);
            }

            if (empty($category->meta_description) && $category->description) {
                $category->meta_description = Str::limit(strip_tags($category->description), 155);
            }

            // Set sort order if not provided
            if (is_null($category->sort_order)) {
                $category->sort_order = static::max('sort_order') + 1;
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = $category->generateUniqueSlug($category->name);
            }
        });

        // Update posts count when blogs are added/removed
        static::saved(function ($category) {
            $category->updatePostsCount();
        });
    }

    /**
     * Generate a unique slug
     */
    public function generateUniqueSlug($name)
    {
        $slug = Str::slug($name);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Update posts count
     */
    public function updatePostsCount()
    {
        $this->posts_count = $this->blogs()->published()->count();
        $this->saveQuietly();
    }

    /**
     * Scope for active categories
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered categories
     */
    public function scopeOrdered(Builder $query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get blogs in this category
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }

    /**
     * Get published blogs in this category
     */
    public function publishedBlogs()
    {
        return $this->blogs()->published();
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Get category color as CSS class
     */
    public function getColorClassAttribute()
    {
        return 'bg-' . $this->color . '-100 text-' . $this->color . '-800 border-' . $this->color . '-200';
    }

    /**
     * Get category icon with fallback
     */
    public function getIconClassAttribute()
    {
        return $this->icon ?: 'fas fa-folder';
    }

    /**
     * Get SEO title
     */
    public function getSeoTitleAttribute()
    {
        return $this->meta_title ?: Str::limit($this->name, 65);
    }

    /**
     * Get SEO description
     */
    public function getSeoDescriptionAttribute()
    {
        return $this->meta_description ?: Str::limit(strip_tags($this->description), 155);
    }

    /**
     * Check if category has posts
     */
    public function hasPosts()
    {
        return $this->posts_count > 0;
    }

    /**
     * Get formatted posts count
     */
    public function getFormattedPostsCountAttribute()
    {
        if ($this->posts_count >= 1000) {
            return round($this->posts_count / 1000, 1) . 'k';
        }
        return $this->posts_count;
    }
}