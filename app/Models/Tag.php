<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_active',
        'meta_title',
        'meta_description',
        'posts_count',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'posts_count' => 'integer',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = $tag->generateUniqueSlug($tag->name);
            }

            if (empty($tag->meta_title)) {
                $tag->meta_title = Str::limit($tag->name, 65);
            }

            if (empty($tag->meta_description) && $tag->description) {
                $tag->meta_description = Str::limit(strip_tags($tag->description), 155);
            }
        });

        static::updating(function ($tag) {
            if ($tag->isDirty('name') && empty($tag->slug)) {
                $tag->slug = $tag->generateUniqueSlug($tag->name);
            }
        });

        // Update posts count when blogs are added/removed
        static::saved(function ($tag) {
            $tag->updatePostsCount();
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
        $this->posts_count = $this->blogs()->whereHas('category', function ($query) {
            $query->where('is_active', true);
        })->published()->count();
        $this->saveQuietly();
    }

    /**
     * Scope for active tags
     */
    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for popular tags (by posts count)
     */
    public function scopePopular(Builder $query, $limit = 10)
    {
        return $query->orderBy('posts_count', 'desc')->limit($limit);
    }

    /**
     * Get blogs with this tag
     */
    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag')->withTimestamps();
    }

    /**
     * Get published blogs with this tag
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
     * Get tag color as CSS class
     */
    public function getColorClassAttribute()
    {
        $colorMap = [
            '#10b981' => 'emerald',
            '#3b82f6' => 'blue',
            '#ef4444' => 'red',
            '#f59e0b' => 'yellow',
            '#8b5cf6' => 'purple',
            '#06b6d4' => 'cyan',
            '#84cc16' => 'lime',
            '#f97316' => 'orange',
            '#ec4899' => 'pink',
        ];

        $colorName = $colorMap[$this->color] ?? 'gray';
        return "bg-{$colorName}-100 dark:bg-{$colorName}-900/20 text-{$colorName}-700 dark:text-{$colorName}-300 border-{$colorName}-200 dark:border-{$colorName}-800";
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
     * Check if tag has posts
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

    /**
     * Find or create tag by name
     */
    public static function findOrCreateByName($name)
    {
        $slug = Str::slug($name);

        return static::firstOrCreate(
            ['slug' => $slug],
            ['name' => $name, 'slug' => $slug]
        );
    }

    /**
     * Create multiple tags from array of names
     */
    public static function createFromNames(array $names)
    {
        $tags = [];

        foreach ($names as $name) {
            if (trim($name)) {
                $tags[] = static::findOrCreateByName(trim($name));
            }
        }

        return collect($tags);
    }
}