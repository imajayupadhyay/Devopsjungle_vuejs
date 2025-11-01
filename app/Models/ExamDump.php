<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ExamDump extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'code',
        'slug',
        'description',
        'full_description',
        'exam_provider_id',
        'difficulty',
        'questions_count',
        'duration_minutes',
        'passing_score',
        'price',
        'original_price',
        'is_free',
        'success_rate',
        'popularity',
        'downloads',
        'views',
        'status',
        'featured',
        'badge',
        'pdf_file',
        'sample_pdf',
        'additional_files',
        'prerequisites',
        'target_audience',
        'what_you_learn',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at',
        'last_updated_at',
    ];

    protected $casts = [
        'is_free' => 'boolean',
        'featured' => 'boolean',
        'additional_files' => 'array',
        'prerequisites' => 'array',
        'target_audience' => 'array',
        'what_you_learn' => 'array',
        'price' => 'decimal:2',
        'original_price' => 'decimal:2',
        'published_at' => 'datetime',
        'last_updated_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($examDump) {
            if (empty($examDump->slug)) {
                $examDump->slug = Str::slug($examDump->code);
            }
        });
    }

    /**
     * Get the provider for this exam dump
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(ExamProvider::class, 'exam_provider_id');
    }

    /**
     * Get all topics for this exam dump
     */
    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(ExamTopic::class, 'exam_dump_topic')
            ->withPivot('coverage_percentage')
            ->withTimestamps();
    }

    /**
     * Get all questions for this exam dump
     */
    public function questions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class);
    }

    /**
     * Get sample questions
     */
    public function sampleQuestions(): HasMany
    {
        return $this->hasMany(ExamQuestion::class)->where('is_sample', true);
    }

    /**
     * Get all reviews for this exam dump
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(ExamReview::class);
    }

    /**
     * Get approved reviews
     */
    public function approvedReviews(): HasMany
    {
        return $this->hasMany(ExamReview::class)->where('is_approved', true);
    }

    /**
     * Get all FAQs for this exam dump
     */
    public function faqs(): HasMany
    {
        return $this->hasMany(ExamFaq::class);
    }

    /**
     * Scope for published exams
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    /**
     * Scope for draft exams
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope for featured exams
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope for free exams
     */
    public function scopeFree($query)
    {
        return $query->where('is_free', true);
    }

    /**
     * Scope for search
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('code', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    /**
     * Scope for filtering by provider
     */
    public function scopeByProvider($query, $providerId)
    {
        return $query->where('exam_provider_id', $providerId);
    }

    /**
     * Scope for filtering by difficulty
     */
    public function scopeByDifficulty($query, $difficulty)
    {
        return $query->where('difficulty', $difficulty);
    }

    /**
     * Publish the exam dump
     */
    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    /**
     * Unpublish the exam dump
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
     * Increment download count
     */
    public function incrementDownloads()
    {
        $this->increment('downloads');
    }

    /**
     * Get average rating
     */
    public function getAverageRatingAttribute()
    {
        return $this->approvedReviews()->avg('rating') ?? 0;
    }

    /**
     * Get total reviews count
     */
    public function getTotalReviewsAttribute()
    {
        return $this->approvedReviews()->count();
    }
}
