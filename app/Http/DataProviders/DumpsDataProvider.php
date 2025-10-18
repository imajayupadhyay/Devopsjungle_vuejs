<?php

namespace App\Http\DataProviders;

class DumpsDataProvider
{
    /**
     * Get all available exam dumps
     */
    public static function getExams(): array
    {
        return [
            [
                'id' => 'aws-saa-c03',
                'title' => 'AWS Certified Solutions Architect - Associate',
                'code' => 'SAA-C03',
                'provider' => 'aws',
                'difficulty' => 'intermediate',
                'questions' => 385,
                'duration' => 130,
                'passingScore' => 720,
                'price' => 299,
                'popularity' => 98,
                'lastUpdated' => '2024-12-15',
                'successRate' => 94,
                'description' => 'Validate technical skills and expertise in designing distributed systems on AWS.',
                'topics' => ['Compute', 'Storage', 'Database', 'Network & Security', 'Management & Governance'],
                'prerequisites' => ['1+ years AWS experience', 'Basic understanding of cloud concepts'],
                'badge' => 'Most Popular',
                'featured' => true
            ],
            [
                'id' => 'aws-soa-c02',
                'title' => 'AWS Certified SysOps Administrator - Associate',
                'code' => 'SOA-C02',
                'provider' => 'aws',
                'difficulty' => 'intermediate',
                'questions' => 298,
                'duration' => 130,
                'passingScore' => 720,
                'price' => 299,
                'popularity' => 85,
                'lastUpdated' => '2024-12-10',
                'successRate' => 91,
                'description' => 'Demonstrate skills in deployment, management, and operations on AWS.',
                'topics' => ['Monitoring & Logging', 'Remediation', 'Cost & Performance', 'Security'],
                'prerequisites' => ['1+ years AWS operations experience'],
                'badge' => null,
                'featured' => false
            ],
            [
                'id' => 'az-900',
                'title' => 'Microsoft Azure Fundamentals',
                'code' => 'AZ-900',
                'provider' => 'azure',
                'difficulty' => 'beginner',
                'questions' => 180,
                'duration' => 85,
                'passingScore' => 700,
                'price' => 199,
                'popularity' => 92,
                'lastUpdated' => '2024-12-18',
                'successRate' => 96,
                'description' => 'Foundational knowledge of cloud services and how they are provided with Azure.',
                'topics' => ['Cloud Concepts', 'Core Azure Services', 'Security', 'Pricing & Support'],
                'prerequisites' => ['None - Entry level'],
                'badge' => 'Entry Level',
                'featured' => true
            ],
            [
                'id' => 'az-104',
                'title' => 'Microsoft Azure Administrator',
                'code' => 'AZ-104',
                'provider' => 'azure',
                'difficulty' => 'intermediate',
                'questions' => 342,
                'duration' => 150,
                'passingScore' => 700,
                'price' => 329,
                'popularity' => 88,
                'lastUpdated' => '2024-12-05',
                'successRate' => 89,
                'description' => 'Manage Azure subscriptions, secure identities, administer infrastructure, and more.',
                'topics' => ['Identity & Governance', 'Storage', 'Compute', 'Virtual Networking', 'Monitor & Backup'],
                'prerequisites' => ['6+ months Azure administration experience'],
                'badge' => 'Popular',
                'featured' => true
            ],
            [
                'id' => 'gcp-ace',
                'title' => 'Google Cloud Associate Cloud Engineer',
                'code' => 'ACE',
                'provider' => 'gcp',
                'difficulty' => 'intermediate',
                'questions' => 275,
                'duration' => 120,
                'passingScore' => 70,
                'price' => 249,
                'popularity' => 78,
                'lastUpdated' => '2024-11-28',
                'successRate' => 87,
                'description' => 'Deploy applications, monitor operations, and manage enterprise solutions on Google Cloud.',
                'topics' => ['Cloud Console & CLI', 'Compute Engine', 'Kubernetes Engine', 'Storage & Databases', 'Networking'],
                'prerequisites' => ['6+ months GCP experience'],
                'badge' => null,
                'featured' => false
            ],
            [
                'id' => 'cka',
                'title' => 'Certified Kubernetes Administrator',
                'code' => 'CKA',
                'provider' => 'kubernetes',
                'difficulty' => 'advanced',
                'questions' => 150,
                'duration' => 180,
                'passingScore' => 66,
                'price' => 395,
                'popularity' => 82,
                'lastUpdated' => '2024-12-01',
                'successRate' => 78,
                'description' => 'Demonstrate skills required to be a successful Kubernetes Administrator.',
                'topics' => ['Cluster Architecture', 'Workloads & Scheduling', 'Services & Networking', 'Storage', 'Troubleshooting'],
                'prerequisites' => ['Strong Linux background', 'Container experience'],
                'badge' => 'Expert Level',
                'featured' => true
            ]
        ];
    }

    /**
     * Get provider categories for filtering
     */
    public static function getProviders(): array
    {
        return [
            ['id' => 'all', 'name' => 'All Providers', 'icon' => 'fas fa-th-large'],
            ['id' => 'aws', 'name' => 'Amazon AWS', 'icon' => 'fab fa-aws'],
            ['id' => 'azure', 'name' => 'Microsoft Azure', 'icon' => 'fab fa-microsoft'],
            ['id' => 'gcp', 'name' => 'Google Cloud', 'icon' => 'fab fa-google'],
            ['id' => 'kubernetes', 'name' => 'Kubernetes', 'icon' => 'fas fa-dharmachakra']
        ];
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
            ['id' => 'advanced', 'name' => 'Advanced']
        ];
    }

    /**
     * Get featured exams
     */
    public static function getFeaturedExams(): array
    {
        $allExams = self::getExams();
        return array_filter($allExams, fn($exam) => $exam['featured'] === true);
    }

    /**
     * Get popular exams (top rated)
     */
    public static function getPopularExams(int $limit = 6): array
    {
        $allExams = self::getExams();

        // Sort by popularity score
        usort($allExams, fn($a, $b) => $b['popularity'] <=> $a['popularity']);

        return array_slice($allExams, 0, $limit);
    }

    /**
     * Get exam by ID
     */
    public static function getExamById(string $examId): ?array
    {
        $exams = self::getExams();

        foreach ($exams as $exam) {
            if ($exam['id'] === $examId) {
                return $exam;
            }
        }

        return null;
    }

    /**
     * Get exams filtered by provider
     */
    public static function getExamsByProvider(string $provider): array
    {
        if ($provider === 'all') {
            return self::getExams();
        }

        $allExams = self::getExams();
        return array_filter($allExams, fn($exam) => $exam['provider'] === $provider);
    }

    /**
     * Get exams filtered by difficulty
     */
    public static function getExamsByDifficulty(string $difficulty): array
    {
        if ($difficulty === 'all') {
            return self::getExams();
        }

        $allExams = self::getExams();
        return array_filter($allExams, fn($exam) => $exam['difficulty'] === $difficulty);
    }

    /**
     * Search exams by query
     */
    public static function searchExams(string $query): array
    {
        $allExams = self::getExams();
        $query = strtolower(trim($query));

        if (empty($query)) {
            return $allExams;
        }

        return array_filter($allExams, function($exam) use ($query) {
            return str_contains(strtolower($exam['title']), $query) ||
                   str_contains(strtolower($exam['code']), $query) ||
                   str_contains(strtolower($exam['description']), $query) ||
                   str_contains(strtolower($exam['provider']), $query);
        });
    }

    /**
     * Get all data for the dumps index page
     */
    public static function getIndexData(): array
    {
        return [
            'exams' => self::getExams(),
            'providers' => self::getProviders(),
            'difficultyLevels' => self::getDifficultyLevels(),
            'featuredExams' => self::getFeaturedExams(),
            'popularExams' => self::getPopularExams()
        ];
    }

    /**
     * Get statistics about all exams
     */
    public static function getExamStatistics(): array
    {
        $exams = self::getExams();

        $totalExams = count($exams);
        $totalQuestions = array_sum(array_column($exams, 'questions'));
        $averageSuccessRate = round(array_sum(array_column($exams, 'successRate')) / $totalExams);

        $providerCounts = [];
        foreach ($exams as $exam) {
            $provider = $exam['provider'];
            $providerCounts[$provider] = ($providerCounts[$provider] ?? 0) + 1;
        }

        return [
            'totalExams' => $totalExams,
            'totalQuestions' => $totalQuestions,
            'averageSuccessRate' => $averageSuccessRate,
            'providerCounts' => $providerCounts,
            'latestUpdate' => max(array_column($exams, 'lastUpdated'))
        ];
    }
}