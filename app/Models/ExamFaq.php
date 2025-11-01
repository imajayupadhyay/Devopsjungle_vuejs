<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamFaq extends Model
{
    protected $fillable = [
        'exam_dump_id',
        'question',
        'answer',
        'is_global',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_global' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the exam dump for this FAQ
     */
    public function examDump(): BelongsTo
    {
        return $this->belongsTo(ExamDump::class);
    }

    /**
     * Scope for global FAQs
     */
    public function scopeGlobal($query)
    {
        return $query->where('is_global', true);
    }

    /**
     * Scope for active FAQs
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered FAQs
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
