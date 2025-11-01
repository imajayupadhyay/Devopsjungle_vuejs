<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamQuestion extends Model
{
    protected $fillable = [
        'exam_dump_id',
        'exam_topic_id',
        'question',
        'options',
        'correct_answer_index',
        'explanation',
        'references',
        'is_sample',
        'difficulty_level',
        'sort_order',
    ];

    protected $casts = [
        'options' => 'array',
        'references' => 'array',
        'is_sample' => 'boolean',
    ];

    /**
     * Get the exam dump for this question
     */
    public function examDump(): BelongsTo
    {
        return $this->belongsTo(ExamDump::class);
    }

    /**
     * Get the topic for this question
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(ExamTopic::class, 'exam_topic_id');
    }

    /**
     * Scope for sample questions
     */
    public function scopeSample($query)
    {
        return $query->where('is_sample', true);
    }

    /**
     * Scope for ordered questions
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
