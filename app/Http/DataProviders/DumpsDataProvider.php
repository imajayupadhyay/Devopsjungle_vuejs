<?php

namespace App\Http\DataProviders;

use App\Models\ExamDump;
use App\Models\ExamProvider;

class DumpsDataProvider
{
    /**
     * Get all available exam dumps
     */
    public static function getExams(): array
    {
        return ExamDump::with(['provider', 'topics'])
            ->published()
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($dump) {
                return [
                    'id' => $dump->slug,
                    'title' => $dump->title,
                    'code' => $dump->code,
                    'provider' => $dump->provider->slug,
                    'difficulty' => $dump->difficulty,
                    'questions' => $dump->questions_count,
                    'duration' => $dump->duration_minutes,
                    'passingScore' => $dump->passing_score,
                    'price' => (float) $dump->price,
                    'popularity' => $dump->popularity ?? ($dump->views > 0 ? min(100, ($dump->downloads / max($dump->views, 1)) * 100 + 50) : 70),
                    'lastUpdated' => $dump->updated_at ? $dump->updated_at->format('Y-m-d') : date('Y-m-d'),
                    'successRate' => $dump->success_rate,
                    'description' => $dump->description,
                    'topics' => $dump->topics->pluck('name')->toArray(),
                    'prerequisites' => $dump->prerequisites ?? [],
                    'badge' => $dump->featured ? ($dump->is_free ? 'FREE' : 'Featured') : null,
                    'featured' => $dump->featured
                ];
            })
            ->toArray();
    }

    /**
     * Get provider categories for filtering
     */
    public static function getProviders(): array
    {
        $providers = ExamProvider::active()
            ->ordered()
            ->withCount('examDumps')
            ->get();

        $allProvidersCount = ExamDump::published()->count();

        $providerData = [
            ['id' => 'all', 'name' => 'All Exams', 'icon' => 'fas fa-globe', 'count' => $allProvidersCount]
        ];

        foreach ($providers as $provider) {
            $providerData[] = [
                'id' => $provider->slug,
                'name' => $provider->name,
                'icon' => $provider->icon ?? 'fas fa-certificate',
                'count' => $provider->exam_dumps_count
            ];
        }

        return $providerData;
    }

    /**
     * Get difficulty levels for filtering
     */
    public static function getDifficultyLevels(): array
    {
        return [
            ['id' => 'all', 'name' => 'All Levels'],
            ['id' => 'beginner', 'name' => 'Beginner'],
            ['id' => 'intermediate', 'name' => 'Intermediate'],
            ['id' => 'expert', 'name' => 'Expert']
        ];
    }

    /**
     * Get featured exams
     */
    public static function getFeaturedExams(): array
    {
        return ExamDump::with(['provider', 'topics'])
            ->published()
            ->featured()
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get()
            ->map(function ($dump) {
                return [
                    'id' => $dump->slug,
                    'title' => $dump->title,
                    'code' => $dump->code,
                    'provider' => $dump->provider->slug,
                    'difficulty' => $dump->difficulty,
                    'questions' => $dump->questions_count,
                    'duration' => $dump->duration_minutes,
                    'passingScore' => $dump->passing_score,
                    'price' => (float) $dump->price,
                    'popularity' => $dump->popularity ?? ($dump->views > 0 ? min(100, ($dump->downloads / max($dump->views, 1)) * 100 + 50) : 70),
                    'lastUpdated' => $dump->updated_at ? $dump->updated_at->format('Y-m-d') : date('Y-m-d'),
                    'successRate' => $dump->success_rate,
                    'description' => $dump->description,
                    'topics' => $dump->topics->pluck('name')->toArray(),
                    'prerequisites' => $dump->prerequisites ?? [],
                    'badge' => $dump->is_free ? 'FREE' : 'Featured',
                    'featured' => true
                ];
            })
            ->toArray();
    }

    /**
     * Get popular exams (top rated)
     */
    public static function getPopularExams(int $limit = 6): array
    {
        return ExamDump::with(['provider', 'topics'])
            ->published()
            ->orderBy('views', 'desc')
            ->orderBy('downloads', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($dump) {
                return [
                    'id' => $dump->slug,
                    'title' => $dump->title,
                    'code' => $dump->code,
                    'provider' => $dump->provider->slug,
                    'difficulty' => $dump->difficulty,
                    'questions' => $dump->questions_count,
                    'duration' => $dump->duration_minutes,
                    'passingScore' => $dump->passing_score,
                    'price' => (float) $dump->price,
                    'popularity' => $dump->popularity ?? ($dump->views > 0 ? min(100, ($dump->downloads / max($dump->views, 1)) * 100 + 50) : 70),
                    'lastUpdated' => $dump->updated_at ? $dump->updated_at->format('Y-m-d') : date('Y-m-d'),
                    'successRate' => $dump->success_rate,
                    'description' => $dump->description,
                    'topics' => $dump->topics->pluck('name')->toArray(),
                    'prerequisites' => $dump->prerequisites ?? [],
                    'badge' => $dump->featured ? ($dump->is_free ? 'FREE' : 'Featured') : null,
                    'featured' => $dump->featured
                ];
            })
            ->toArray();
    }

    /**
     * Get exam by ID (slug)
     */
    public static function getExamById(string $examId): ?array
    {
        $dump = ExamDump::with(['provider', 'topics'])
            ->where('slug', $examId)
            ->orWhere('code', $examId)
            ->published()
            ->first();

        if (!$dump) {
            return null;
        }

        // Increment views
        $dump->increment('views');

        return [
            'id' => $dump->slug,
            'title' => $dump->title,
            'code' => $dump->code,
            'provider' => $dump->provider->slug,
            'difficulty' => $dump->difficulty,
            'questions' => $dump->questions_count,
            'duration' => $dump->duration_minutes,
            'passingScore' => $dump->passing_score,
            'price' => (float) $dump->price,
            'popularity' => $dump->views_count > 0 ? min(100, ($dump->downloads_count / max($dump->views_count, 1)) * 100 + 50) : 70,
            'lastUpdated' => $dump->updated_at->format('Y-m-d'),
            'successRate' => $dump->success_rate,
            'description' => $dump->short_description,
            'topics' => $dump->topics->pluck('name')->toArray(),
            'prerequisites' => $dump->prerequisites ?? [],
            'badge' => $dump->featured ? ($dump->is_free ? 'FREE' : 'Featured') : null,
            'featured' => $dump->featured
        ];
    }

    /**
     * Get exams filtered by provider
     */
    public static function getExamsByProvider(string $provider): array
    {
        if ($provider === 'all') {
            return self::getExams();
        }

        return ExamDump::with(['provider', 'topics'])
            ->published()
            ->whereHas('provider', function ($query) use ($provider) {
                $query->where('slug', $provider);
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($dump) {
                return [
                    'id' => $dump->slug,
                    'title' => $dump->title,
                    'code' => $dump->code,
                    'provider' => $dump->provider->slug,
                    'difficulty' => $dump->difficulty,
                    'questions' => $dump->questions_count,
                    'duration' => $dump->duration_minutes,
                    'passingScore' => $dump->passing_score,
                    'price' => (float) $dump->price,
                    'popularity' => $dump->popularity ?? ($dump->views > 0 ? min(100, ($dump->downloads / max($dump->views, 1)) * 100 + 50) : 70),
                    'lastUpdated' => $dump->updated_at ? $dump->updated_at->format('Y-m-d') : date('Y-m-d'),
                    'successRate' => $dump->success_rate,
                    'description' => $dump->description,
                    'topics' => $dump->topics->pluck('name')->toArray(),
                    'prerequisites' => $dump->prerequisites ?? [],
                    'badge' => $dump->featured ? ($dump->is_free ? 'FREE' : 'Featured') : null,
                    'featured' => $dump->featured
                ];
            })
            ->toArray();
    }

    /**
     * Get exams filtered by difficulty
     */
    public static function getExamsByDifficulty(string $difficulty): array
    {
        if ($difficulty === 'all') {
            return self::getExams();
        }

        return ExamDump::with(['provider', 'topics'])
            ->published()
            ->where('difficulty', $difficulty)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($dump) {
                return [
                    'id' => $dump->slug,
                    'title' => $dump->title,
                    'code' => $dump->code,
                    'provider' => $dump->provider->slug,
                    'difficulty' => $dump->difficulty,
                    'questions' => $dump->questions_count,
                    'duration' => $dump->duration_minutes,
                    'passingScore' => $dump->passing_score,
                    'price' => (float) $dump->price,
                    'popularity' => $dump->popularity ?? ($dump->views > 0 ? min(100, ($dump->downloads / max($dump->views, 1)) * 100 + 50) : 70),
                    'lastUpdated' => $dump->updated_at ? $dump->updated_at->format('Y-m-d') : date('Y-m-d'),
                    'successRate' => $dump->success_rate,
                    'description' => $dump->description,
                    'topics' => $dump->topics->pluck('name')->toArray(),
                    'prerequisites' => $dump->prerequisites ?? [],
                    'badge' => $dump->featured ? ($dump->is_free ? 'FREE' : 'Featured') : null,
                    'featured' => $dump->featured
                ];
            })
            ->toArray();
    }

    /**
     * Search exams by query
     */
    public static function searchExams(string $query): array
    {
        if (empty(trim($query))) {
            return self::getExams();
        }

        return ExamDump::with(['provider', 'topics'])
            ->published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', '%' . $query . '%')
                    ->orWhere('code', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%')
                    ->orWhere('full_description', 'like', '%' . $query . '%');
            })
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($dump) {
                return [
                    'id' => $dump->slug,
                    'title' => $dump->title,
                    'code' => $dump->code,
                    'provider' => $dump->provider->slug,
                    'difficulty' => $dump->difficulty,
                    'questions' => $dump->questions_count,
                    'duration' => $dump->duration_minutes,
                    'passingScore' => $dump->passing_score,
                    'price' => (float) $dump->price,
                    'popularity' => $dump->popularity ?? ($dump->views > 0 ? min(100, ($dump->downloads / max($dump->views, 1)) * 100 + 50) : 70),
                    'lastUpdated' => $dump->updated_at ? $dump->updated_at->format('Y-m-d') : date('Y-m-d'),
                    'successRate' => $dump->success_rate,
                    'description' => $dump->description,
                    'topics' => $dump->topics->pluck('name')->toArray(),
                    'prerequisites' => $dump->prerequisites ?? [],
                    'badge' => $dump->featured ? ($dump->is_free ? 'FREE' : 'Featured') : null,
                    'featured' => $dump->featured
                ];
            })
            ->toArray();
    }

    /**
     * Get all data for the dumps index page
     */
    public static function getIndexData(): array
    {
        return [
            'exams' => self::getExams(),
            'categories' => self::getProviders(),
            'providers' => self::getProviders(),
            'difficultyLevels' => self::getDifficultyLevels(),
            'featuredExams' => self::getFeaturedExams(),
            'popularExams' => self::getPopularExams(),
            'stats' => self::getExamStatistics()
        ];
    }

    /**
     * Get statistics about all exams
     */
    public static function getExamStatistics(): array
    {
        $totalExams = ExamDump::published()->count();
        $totalQuestions = ExamDump::published()->sum('questions_count');
        $averageSuccessRate = ExamDump::published()->avg('success_rate');

        $providerCounts = [];
        $providers = ExamProvider::active()->withCount('examDumps')->get();

        foreach ($providers as $provider) {
            $providerCounts[$provider->slug] = $provider->exam_dumps_count;
        }

        $latestUpdate = ExamDump::published()->max('updated_at');

        return [
            'totalExams' => $totalExams,
            'totalQuestions' => $totalQuestions,
            'averageSuccessRate' => round($averageSuccessRate),
            'providerCounts' => $providerCounts,
            'latestUpdate' => $latestUpdate ? \Carbon\Carbon::parse($latestUpdate)->format('Y-m-d') : null
        ];
    }
}
