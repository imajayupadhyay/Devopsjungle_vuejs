<?php

namespace App\Http\DataProviders;

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
        $currentExam = self::getExamDetail($examId);

        if (!$currentExam) {
            return [];
        }

        $allExams = DumpsDataProvider::getExams();

        // Filter exams from same provider, excluding current exam
        $relatedExams = array_filter($allExams, function($exam) use ($currentExam, $examId) {
            return $exam['provider'] === $currentExam['provider'] && $exam['id'] !== $examId;
        });

        // Sort by popularity and take the specified limit
        usort($relatedExams, fn($a, $b) => $b['popularity'] <=> $a['popularity']);

        return array_slice($relatedExams, 0, $limit);
    }

    /**
     * Get exam features and highlights
     */
    public static function getExamFeatures(string $examId): array
    {
        $exam = self::getExamDetail($examId);

        if (!$exam) {
            return [];
        }

        $baseFeatures = [
            [
                'icon' => 'fas fa-questions',
                'title' => 'Total Questions',
                'value' => $exam['questions'],
                'description' => 'Practice questions included'
            ],
            [
                'icon' => 'fas fa-clock',
                'title' => 'Duration',
                'value' => $exam['duration'] . ' mins',
                'description' => 'Actual exam time limit'
            ],
            [
                'icon' => 'fas fa-trophy',
                'title' => 'Passing Score',
                'value' => $exam['passingScore'],
                'description' => 'Minimum score required'
            ],
            [
                'icon' => 'fas fa-chart-line',
                'title' => 'Success Rate',
                'value' => $exam['successRate'] . '%',
                'description' => 'Students who passed'
            ],
            [
                'icon' => 'fas fa-calendar-alt',
                'title' => 'Last Updated',
                'value' => date('M Y', strtotime($exam['lastUpdated'])),
                'description' => 'Content freshness'
            ],
            [
                'icon' => 'fas fa-star',
                'title' => 'Popularity',
                'value' => $exam['popularity'] . '%',
                'description' => 'Student rating'
            ]
        ];

        return $baseFeatures;
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
        // In a real application, these would come from a database
        $testimonials = [
            'aws-saa-c03' => [
                [
                    'id' => 1,
                    'name' => 'Sarah Johnson',
                    'role' => 'Cloud Engineer',
                    'company' => 'Tech Solutions Inc.',
                    'rating' => 5,
                    'comment' => 'The practice questions were spot-on! I passed my SAA-C03 exam on the first try. The explanations helped me understand the concepts deeply.',
                    'date' => '2024-12-10',
                    'verified' => true
                ],
                [
                    'id' => 2,
                    'name' => 'Michael Chen',
                    'role' => 'DevOps Engineer',
                    'company' => 'StartupXYZ',
                    'rating' => 5,
                    'comment' => 'Excellent resource! The questions closely matched the actual exam format. Highly recommend for anyone preparing for AWS certification.',
                    'date' => '2024-12-08',
                    'verified' => true
                ],
                [
                    'id' => 3,
                    'name' => 'Jennifer Williams',
                    'role' => 'Solutions Architect',
                    'company' => 'Enterprise Corp',
                    'rating' => 4,
                    'comment' => 'Great practice material with detailed explanations. Helped me identify my weak areas and focus my studies effectively.',
                    'date' => '2024-12-05',
                    'verified' => true
                ]
            ],
            'az-900' => [
                [
                    'id' => 1,
                    'name' => 'David Rodriguez',
                    'role' => 'IT Administrator',
                    'company' => 'Global Systems',
                    'rating' => 5,
                    'comment' => 'Perfect for beginners! The AZ-900 dumps helped me understand Azure fundamentals and pass the exam confidently.',
                    'date' => '2024-12-12',
                    'verified' => true
                ]
            ]
        ];

        return $testimonials[$examId] ?? [];
    }

    /**
     * Get frequently asked questions for an exam
     */
    public static function getExamFAQ(): array
    {
        return [
            [
                'question' => 'How often are the exam dumps updated?',
                'answer' => 'Our exam dumps are updated regularly, typically within 2-4 weeks of any official exam changes. You\'ll receive all updates for free.'
            ],
            [
                'question' => 'What format are the practice questions in?',
                'answer' => 'Questions are provided in multiple formats including PDF, online practice tests, and mobile-compatible formats for studying anywhere.'
            ],
            [
                'question' => 'Do you offer a money-back guarantee?',
                'answer' => 'Yes! We offer a 100% money-back guarantee if you don\'t pass your exam after using our materials as directed.'
            ],
            [
                'question' => 'How long do I have access to the materials?',
                'answer' => 'You get lifetime access to all purchased materials, including any future updates and improvements.'
            ],
            [
                'question' => 'Are the questions from the actual exam?',
                'answer' => 'Our questions are carefully crafted to match the style, difficulty, and topics of the actual exam based on the official exam guide.'
            ],
            [
                'question' => 'Can I access the materials on mobile devices?',
                'answer' => 'Yes! All our materials are optimized for mobile devices, tablets, and desktop computers for flexible studying.'
            ]
        ];
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
            'faq' => self::getExamFAQ()
        ];
    }

    /**
     * Get exam pricing and package information
     */
    public static function getExamPackages(string $examId): array
    {
        $exam = self::getExamDetail($examId);

        if (!$exam) {
            return [];
        }

        return [
            'basic' => [
                'name' => 'Basic Package',
                'price' => $exam['price'],
                'originalPrice' => $exam['price'] + 50,
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
                'price' => $exam['price'] + 100,
                'originalPrice' => $exam['price'] + 200,
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
                'price' => $exam['price'] + 200,
                'originalPrice' => $exam['price'] + 350,
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