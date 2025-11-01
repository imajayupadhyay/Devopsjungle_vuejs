<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamProvider extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'description',
        'gradient_color',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get all exam dumps for this provider
     */
    public function examDumps(): HasMany
    {
        return $this->hasMany(ExamDump::class);
    }

    /**
     * Scope to get only active providers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
