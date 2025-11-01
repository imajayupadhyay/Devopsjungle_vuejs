<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamReview extends Model
{
    protected $fillable = [
        'exam_dump_id',
        'reviewer_name',
        'reviewer_initials',
        'reviewer_role',
        'rating',
        'title',
        'content',
        'verified_purchase',
        'helpful_count',
        'is_approved',
    ];

    protected $casts = [
        'verified_purchase' => 'boolean',
        'is_approved' => 'boolean',
    ];

    /**
     * Get the exam dump for this review
     */
    public function examDump(): BelongsTo
    {
        return $this->belongsTo(ExamDump::class);
    }

    /**
     * Scope for approved reviews
     */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    /**
     * Scope for pending reviews
     */
    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    /**
     * Approve the review
     */
    public function approve()
    {
        $this->update(['is_approved' => true]);
    }

    /**
     * Increment helpful count
     */
    public function incrementHelpful()
    {
        $this->increment('helpful_count');
    }
}
