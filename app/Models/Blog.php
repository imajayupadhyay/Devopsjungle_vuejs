<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'gallery_images',
        'author_name',
        'author_avatar',
        'author_role',
        'author_bio',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'canonical_url',
        'social_meta',
        'category_id',
        'status',
        'published_at',
        'scheduled_at',
        'views',
        'read_time',
        'featured',
        'password',
        'comment_status',
        'ping_status',
        'sticky',
        'parent_id',
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'social_meta' => 'array',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
        'featured' => 'boolean',
        'ping_status' => 'boolean',
        'sticky' => 'boolean',
    ];

    protected $dates = [
        'published_at',
        'scheduled_at',
    ];

    /**
     * Boot the model
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $blog->slug = $blog->generateUniqueSlug($blog->title);
            }

            if (empty($blog->read_time)) {
                $blog->read_time = $blog->calculateReadTime($blog->content);
            }

            if (empty($blog->meta_title)) {
                $blog->meta_title = Str::limit($blog->title, 65);
            }

            if (empty($blog->meta_description)) {
                $blog->meta_description = Str::limit(strip_tags($blog->excerpt), 155);
            }
        });

        static::updating(function ($blog) {
            if ($blog->isDirty('title') && empty($blog->slug)) {
                $blog->slug = $blog->generateUniqueSlug($blog->title);
            }

            if ($blog->isDirty('content')) {
                $blog->read_time = $blog->calculateReadTime($blog->content);
            }
        });
    }

    /**
     * Generate a unique slug
     */
    public function generateUniqueSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Calculate read time based on content
     */
    public function calculateReadTime($content)
    {
        $wordCount = str_word_count(strip_tags($content));
        return max(1, ceil($wordCount / 200)); // Average reading speed: 200 words per minute
    }

    /**
     * Scope for published blogs
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope for draft blogs
     */
    public function scopeDraft(Builder $query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope for scheduled blogs
     */
    public function scopeScheduled(Builder $query)
    {
        return $query->where('status', 'scheduled')
                    ->where('scheduled_at', '>', now());
    }

    /**
     * Scope for featured blogs
     */
    public function scopeFeatured(Builder $query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for search
     */
    public function scopeSearch(Builder $query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('excerpt', 'like', "%{$search}%")
              ->orWhere('content', 'like', "%{$search}%")
              ->orWhere('category', 'like', "%{$search}%")
              ->orWhere('author_name', 'like', "%{$search}%");
        });
    }

    /**
     * Scope for category
     */
    public function scopeCategory(Builder $query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    /**
     * Get category relationship
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get tags relationship
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag')->withTimestamps();
    }

    /**
     * Get parent blog (for revisions)
     */
    public function parent()
    {
        return $this->belongsTo(Blog::class, 'parent_id');
    }

    /**
     * Get child blogs (revisions)
     */
    public function revisions()
    {
        return $this->hasMany(Blog::class, 'parent_id');
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Check if blog is published
     */
    public function isPublished()
    {
        return $this->status === 'published' &&
               $this->published_at &&
               $this->published_at->isPast();
    }

    /**
     * Check if blog is scheduled
     */
    public function isScheduled()
    {
        return $this->status === 'scheduled' &&
               $this->scheduled_at &&
               $this->scheduled_at->isFuture();
    }

    /**
     * Publish the blog
     */
    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    /**
     * Unpublish the blog (make it draft)
     */
    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
            'published_at' => null,
        ]);
    }

    /**
     * Schedule the blog
     */
    public function schedule(Carbon $date)
    {
        $this->update([
            'status' => 'scheduled',
            'scheduled_at' => $date,
        ]);
    }

    /**
     * Increment views
     */
    public function incrementViews()
    {
        $this->increment('views');
    }

    /**
     * Get formatted published date
     */
    public function getFormattedPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M d, Y') : null;
    }

    /**
     * Get SEO title (meta_title or title)
     */
    public function getSeoTitleAttribute()
    {
        return $this->meta_title ?: Str::limit($this->title, 65);
    }

    /**
     * Get SEO description (meta_description or excerpt)
     */
    public function getSeoDescriptionAttribute()
    {
        return $this->meta_description ?: Str::limit(strip_tags($this->excerpt), 155);
    }

    /**
     * Get author information as array
     */
    public function getAuthorAttribute()
    {
        return [
            'name' => $this->author_name,
            'avatar' => $this->author_avatar ?: 'https://ui-avatars.com/api/?name=' . urlencode($this->author_name) . '&background=047857&color=fff',
            'role' => $this->author_role,
            'bio' => $this->author_bio,
        ];
    }

    /**
     * Get read time formatted
     */
    public function getReadTimeFormattedAttribute()
    {
        return $this->read_time . ' min read';
    }

    /**
     * Get status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'published' => 'green',
            'draft' => 'gray',
            'scheduled' => 'blue',
            'archived' => 'red',
            default => 'gray',
        };
    }
}