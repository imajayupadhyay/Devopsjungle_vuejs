<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ExamTopic extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'percentage',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all exam dumps that include this topic
     */
    public function examDumps(): BelongsToMany
    {
        return $this->belongsToMany(ExamDump::class, 'exam_dump_topic')
            ->withPivot('coverage_percentage')
            ->withTimestamps();
    }

    /**
     * Scope to get only active topics
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
