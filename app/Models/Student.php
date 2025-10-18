<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'preferences',
        'avatar',
        'bio',
        'date_of_birth',
        'gender',
        'country',
        'city',
        'timezone',
        'last_login_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'date_of_birth' => 'date',
            'preferences' => 'array',
            'password' => 'hashed',
        ];
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($student) {
            if (!$student->timezone) {
                $student->timezone = 'UTC';
            }
        });
    }

    /**
     * Get the student's full name.
     */
    public function getFullNameAttribute(): string
    {
        return $this->name;
    }

    /**
     * Get the student's initials.
     */
    public function getInitialsAttribute(): string
    {
        $words = explode(' ', $this->name);
        $initials = '';

        foreach ($words as $word) {
            $initials .= strtoupper(substr($word, 0, 1));
        }

        return substr($initials, 0, 2);
    }

    /**
     * Get the student's avatar URL.
     */
    public function getAvatarUrlAttribute(): string
    {
        if ($this->avatar) {
            return asset('storage/' . $this->avatar);
        }

        // Generate a default avatar using initials
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=059669&background=e0f2fe&size=128';
    }

    /**
     * Check if the student is active.
     */
    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    /**
     * Check if the student is suspended.
     */
    public function isSuspended(): bool
    {
        return $this->status === 'suspended';
    }

    /**
     * Update the student's last login timestamp.
     */
    public function updateLastLogin(): void
    {
        $this->update(['last_login_at' => now()]);
    }

    /**
     * Get the student's preferred timezone.
     */
    public function getTimezoneAttribute($value): string
    {
        return $value ?? 'UTC';
    }

    /**
     * Scope a query to only include active students.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to only include verified students.
     */
    public function scopeVerified($query)
    {
        return $query->whereNotNull('email_verified_at');
    }

    /**
     * Scope a query to search students by name or email.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }

    /**
     * Get students registered in the last X days.
     */
    public function scopeRecentlyRegistered($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
