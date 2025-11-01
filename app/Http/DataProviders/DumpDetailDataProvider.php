<?php

namespace App\Http\DataProviders;

use App\Models\ExamDump;
use App\Models\ExamReview;
use App\Models\ExamFaq;

class DumpDetailDataProvider
{
    /**
     * Get detailed exam information by ID
     */
    public static function getExamDetail(string $examId): ?array
    {
        return DumpsDataProvider::getExamById($examId);
    }

    /**
     * Get related exams (same provider, excluding current)
     */
    public static function getRelatedExams(string $examId, int $limit = 3): array
    {
        $currentExam = ExamDump::where('slug', $examId)
            ->orWhere('code', $examId)
            ->published()
            ->first();

        if (!$currentExam) {
            return [];
        }

        return ExamDump::with(['provider', 'topics'])
            ->published()
            ->where('exam_provider_id', $currentExam->exam_provider_id)
            ->where('id', '!=', $currentExam->id)
            ->orderBy('views', 'desc')
            ->limit($limit)
            ->get()
            ->map(function ($dump) {
                return [
                    'id' => $dump->slug,
                    'title' => $dump->title,
                    'code' => $dump->code,
                    'provider' => $dump->provider->slug,
                    'description' => $dump->description
                ];
            })
            ->toArray();
    }

    /**
     * Get exam features and highlights
     */
    public static function getExamFeatures(string $examId): array
    {
        $dump = ExamDump::where('slug', $examId)
            ->orWhere('code', $examId)
            ->published()
            ->first();

        if (!$dump) {
            return [];
        }

        return [
            [
                'icon' => 'fas fa-questions',
                'title' => 'Total Questions',
                'value' => $dump->questions_count,
                'description' => 'Practice questions included'
            ],
            [
                'icon' => 'fas fa-clock',
                'title' => 'Duration',
                'value' => $dump->duration_minutes . ' mins',
                'description' => 'Actual exam time limit'
            ],
            [
                'icon' => 'fas fa-trophy',
                'title' => 'Passing Score',
                'value' => $dump->passing_score,
                'description' => 'Minimum score required'
            ],
            [
                'icon' => 'fas fa-chart-line',
                'title' => 'Success Rate',
                'value' => $dump->success_rate . '%',
                'description' => 'Students who passed'
            ],
            [
                'icon' => 'fas fa-calendar-alt',
                'title' => 'Last Updated',
                'value' => $dump->updated_at ? $dump->updated_at->format('M Y') : date('M Y'),
                'description' => 'Content freshness'
            ],
            [
                'icon' => 'fas fa-star',
                'title' => 'Popularity',
                'value' => $dump->views,
                'description' => 'Total views'
            ]
        ];
    }

    /**
     * Get exam benefits and what's included
     */
    public static function getExamBenefits(): array
    {
        return [
            [
                'icon' => 'fas fa-download',
                'title' => 'Instant Download',
                'description' => 'Get immediate access to all exam materials after purchase'
            ],
            [
                'icon' => 'fas fa-sync-alt',
                'title' => 'Regular Updates',
                'description' => 'Content updated regularly to match latest exam changes'
            ],
            [
                'icon' => 'fas fa-mobile-alt',
                'title' => 'Mobile Compatible',
                'description' => 'Study anywhere with mobile-friendly question formats'
            ],
            [
                'icon' => 'fas fa-headset',
                'title' => '24/7 Support',
                'description' => 'Get help whenever you need it from our support team'
            ],
            [
                'icon' => 'fas fa-shield-alt',
                'title' => 'Money Back Guarantee',
                'description' => '100% money back guarantee if you don\'t pass the exam'
            ],
            [
                'icon' => 'fas fa-infinity',
                'title' => 'Lifetime Access',
                'description' => 'Access your purchased materials forever with all updates'
            ]
        ];
    }

    /**
     * Get exam testimonials and reviews
     */
    public static function getExamTestimonials(string $examId): array
    {
        $dump = ExamDump::where('slug', $examId)
            ->orWhere('code', $examId)
            ->published()
            ->first();

        if (!$dump) {
            return [];
        }

        return ExamReview::where('exam_dump_id', $dump->id)
            ->where('is_approved', true)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id,
                    'name' => $review->reviewer_name,
                    'role' => $review->reviewer_title ?? 'Certified Professional',
                    'company' => $review->reviewer_company ?? '',
                    'rating' => $review->rating,
                    'comment' => $review->review_text,
                    'date' => $review->created_at->format('Y-m-d'),
                    'verified' => $review->verified_purchase
                ];
            })
            ->toArray();
    }

    /**
     * Get frequently asked questions for an exam
     */
    public static function getExamFAQ(string $examId = null): array
    {
        $query = ExamFaq::query();

        if ($examId) {
            $dump = ExamDump::where('slug', $examId)
                ->orWhere('code', $examId)
                ->published()
                ->first();

            if ($dump) {
                $query->where(function ($q) use ($dump) {
                    $q->where('exam_dump_id', $dump->id)
                      ->orWhere('is_global', true);
                });
            } else {
                $query->where('is_global', true);
            }
        } else {
            $query->where('is_global', true);
        }

        return $query->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($faq) {
                return [
                    'question' => $faq->question,
                    'answer' => $faq->answer
                ];
            })
            ->toArray();
    }

    /**
     * Get all data for the dump detail page
     */
    public static function getDetailPageData(string $examId): array
    {
        $exam = self::getExamDetail($examId);

        if (!$exam) {
            return [];
        }

        return [
            'exam' => $exam,
            'relatedExams' => self::getRelatedExams($examId),
            'features' => self::getExamFeatures($examId),
            'benefits' => self::getExamBenefits(),
            'testimonials' => self::getExamTestimonials($examId),
            'faq' => self::getExamFAQ($examId)
        ];
    }

    /**
     * Get exam pricing and package information
     */
    public static function getExamPackages(string $examId): array
    {
        $dump = ExamDump::where('slug', $examId)
            ->orWhere('code', $examId)
            ->published()
            ->first();

        if (!$dump) {
            return [];
        }

        $basePrice = (float) $dump->price;

        return [
            'basic' => [
                'name' => 'Basic Package',
                'price' => $basePrice,
                'originalPrice' => $basePrice + 50,
                'features' => [
                    'PDF Practice Questions',
                    'Detailed Explanations',
                    'Mobile Access',
                    'Basic Support'
                ],
                'popular' => false
            ],
            'premium' => [
                'name' => 'Premium Package',
                'price' => $basePrice + 100,
                'originalPrice' => $basePrice + 200,
                'features' => [
                    'Everything in Basic',
                    'Online Practice Tests',
                    'Performance Analytics',
                    'Priority Support',
                    'Exam Simulator',
                    'Study Guides'
                ],
                'popular' => true
            ],
            'ultimate' => [
                'name' => 'Ultimate Package',
                'price' => $basePrice + 200,
                'originalPrice' => $basePrice + 350,
                'features' => [
                    'Everything in Premium',
                    'Video Explanations',
                    '1-on-1 Mentoring Session',
                    'Custom Study Plan',
                    'Exam Retake Insurance',
                    'Career Guidance'
                ],
                'popular' => false
            ]
        ];
    }
}
