<?php

namespace App\Http\DataProviders;

class ServicesDataProvider
{
    /**
     * Get all available services
     */
    public static function getServices(): array
    {
        return [
            [
                'id' => 'corporate-devops-training',
                'title' => 'Corporate DevOps Training',
                'category' => 'training',
                'icon' => 'fas fa-building',
                'description' => 'Comprehensive DevOps training program designed for corporate teams and organizations.',
                'duration' => '2-4 weeks',
                'rating' => 4.9,
                'clients' => 150,
                'reviews' => 45,
                'deliveryTime' => '2-4 weeks',
                'type' => 'group',
                'features' => [
                    'Customized curriculum based on your tech stack',
                    'Hands-on workshops and labs',
                    'Team collaboration exercises',
                    'Best practices implementation',
                    'Post-training support and consultation',
                    'Certificate of completion'
                ],
                'pricing' => [
                    'display' => 'Custom Quote',
                    'period' => null,
                    'originalPrice' => null,
                    'savings' => null
                ]
            ],
            [
                'id' => 'one-on-one-devops-mentoring',
                'title' => 'One-on-One DevOps Mentoring',
                'category' => 'mentoring',
                'icon' => 'fas fa-user-graduate',
                'description' => 'Personalized mentoring sessions with experienced DevOps professionals.',
                'duration' => '1-3 months',
                'rating' => 4.9,
                'clients' => 320,
                'reviews' => 156,
                'deliveryTime' => 'Flexible',
                'type' => 'individual',
                'features' => [
                    'Personalized learning path',
                    'Weekly 1-hour sessions',
                    'Career guidance and planning',
                    'Resume and portfolio review',
                    'Interview preparation',
                    'Industry insights and networking'
                ],
                'pricing' => [
                    'display' => '$199',
                    'period' => '/month',
                    'originalPrice' => 249,
                    'savings' => 20
                ]
            ],
            [
                'id' => 'job-placement-assistance',
                'title' => 'Job Placement Assistance',
                'category' => 'job-assistance',
                'icon' => 'fas fa-briefcase',
                'description' => 'Complete job placement support including resume building, interview prep, and job matching.',
                'duration' => '3-6 months',
                'rating' => 4.8,
                'clients' => 450,
                'reviews' => 234,
                'deliveryTime' => '3-6 months',
                'type' => 'individual',
                'features' => [
                    'Professional resume and LinkedIn optimization',
                    'Mock interview sessions',
                    'Job matching with partner companies',
                    'Salary negotiation guidance',
                    'Portfolio development',
                    '90% job placement success rate'
                ],
                'pricing' => [
                    'display' => '$299',
                    'period' => '/package',
                    'originalPrice' => 399,
                    'savings' => 25
                ]
            ],
            [
                'id' => 'cloud-migration-consulting',
                'title' => 'Cloud Migration Consulting',
                'category' => 'consulting',
                'icon' => 'fas fa-cloud-upload-alt',
                'description' => 'Expert guidance for migrating your infrastructure and applications to the cloud.',
                'duration' => '4-12 weeks',
                'rating' => 4.9,
                'clients' => 85,
                'reviews' => 67,
                'deliveryTime' => '4-12 weeks',
                'type' => 'enterprise',
                'features' => [
                    'Current infrastructure assessment',
                    'Migration strategy development',
                    'Cost optimization planning',
                    'Security and compliance review',
                    'Hands-on migration support',
                    'Post-migration optimization'
                ],
                'pricing' => [
                    'display' => 'Custom Quote',
                    'period' => null,
                    'originalPrice' => null,
                    'savings' => null
                ]
            ],
            [
                'id' => 'devops-toolchain-setup',
                'title' => 'DevOps Toolchain Setup',
                'category' => 'implementation',
                'icon' => 'fas fa-tools',
                'description' => 'Complete setup and configuration of DevOps tools and CI/CD pipelines.',
                'duration' => '2-6 weeks',
                'rating' => 4.7,
                'clients' => 120,
                'reviews' => 89,
                'deliveryTime' => '2-6 weeks',
                'type' => 'team',
                'features' => [
                    'Tool selection and evaluation',
                    'CI/CD pipeline setup',
                    'Automated testing integration',
                    'Monitoring and alerting configuration',
                    'Documentation and training',
                    'Ongoing support and maintenance'
                ],
                'pricing' => [
                    'display' => '$2,999',
                    'period' => '/project',
                    'originalPrice' => 3999,
                    'savings' => 25
                ]
            ],
            [
                'id' => 'infrastructure-audit',
                'title' => 'Infrastructure Security Audit',
                'category' => 'audit',
                'icon' => 'fas fa-shield-alt',
                'description' => 'Comprehensive security audit of your cloud and on-premise infrastructure.',
                'duration' => '1-3 weeks',
                'rating' => 4.8,
                'clients' => 200,
                'reviews' => 145,
                'deliveryTime' => '1-3 weeks',
                'type' => 'assessment',
                'features' => [
                    'Security vulnerability assessment',
                    'Compliance review (SOC2, PCI, HIPAA)',
                    'Network security analysis',
                    'Access control evaluation',
                    'Detailed remediation plan',
                    'Executive summary report'
                ],
                'pricing' => [
                    'display' => '$1,499',
                    'period' => '/audit',
                    'originalPrice' => 1999,
                    'savings' => 25
                ]
            ]
        ];
    }

    /**
     * Get service categories
     */
    public static function getCategories(): array
    {
        return [
            ['id' => 'all', 'name' => 'All Services', 'icon' => 'fas fa-th-large'],
            ['id' => 'training', 'name' => 'Training', 'icon' => 'fas fa-graduation-cap'],
            ['id' => 'mentoring', 'name' => 'Mentoring', 'icon' => 'fas fa-user-graduate'],
            ['id' => 'job-assistance', 'name' => 'Job Assistance', 'icon' => 'fas fa-briefcase'],
            ['id' => 'consulting', 'name' => 'Consulting', 'icon' => 'fas fa-lightbulb'],
            ['id' => 'implementation', 'name' => 'Implementation', 'icon' => 'fas fa-tools'],
            ['id' => 'audit', 'name' => 'Audit & Assessment', 'icon' => 'fas fa-shield-alt']
        ];
    }

    /**
     * Get service types
     */
    public static function getServiceTypes(): array
    {
        return [
            ['id' => 'all', 'name' => 'All Types'],
            ['id' => 'individual', 'name' => 'Individual'],
            ['id' => 'team', 'name' => 'Team'],
            ['id' => 'group', 'name' => 'Group'],
            ['id' => 'enterprise', 'name' => 'Enterprise'],
            ['id' => 'assessment', 'name' => 'Assessment']
        ];
    }

    /**
     * Get service by ID
     */
    public static function getServiceById(string $serviceId): ?array
    {
        $services = self::getServices();

        foreach ($services as $service) {
            if ($service['id'] === $serviceId) {
                return $service;
            }
        }

        return null;
    }

    /**
     * Get popular services (highest rated)
     */
    public static function getPopularServices(int $limit = 4): array
    {
        $allServices = self::getServices();

        // Sort by rating
        usort($allServices, fn($a, $b) => $b['rating'] <=> $a['rating']);

        return array_slice($allServices, 0, $limit);
    }

    /**
     * Get services by category
     */
    public static function getServicesByCategory(string $category): array
    {
        if ($category === 'all') {
            return self::getServices();
        }

        $allServices = self::getServices();
        return array_filter($allServices, fn($service) => $service['category'] === $category);
    }

    /**
     * Get services by type
     */
    public static function getServicesByType(string $type): array
    {
        if ($type === 'all') {
            return self::getServices();
        }

        $allServices = self::getServices();
        return array_filter($allServices, fn($service) => $service['type'] === $type);
    }

    /**
     * Get all data for the services index page
     */
    public static function getIndexData(): array
    {
        return [
            'services' => self::getServices(),
            'categories' => self::getCategories(),
            'serviceTypes' => self::getServiceTypes(),
            'popularServices' => self::getPopularServices()
        ];
    }

    /**
     * Get all data for the service detail page
     */
    public static function getDetailPageData(string $serviceId): array
    {
        $service = self::getServiceById($serviceId);

        if (!$service) {
            return [];
        }

        return [
            'service' => $service
        ];
    }

    /**
     * Get service statistics
     */
    public static function getServiceStatistics(): array
    {
        $services = self::getServices();

        $totalServices = count($services);
        $totalClients = array_sum(array_column($services, 'clients'));
        $averageRating = round(array_sum(array_column($services, 'rating')) / $totalServices, 1);

        $categoryStats = [];
        foreach ($services as $service) {
            $category = $service['category'];
            $categoryStats[$category] = ($categoryStats[$category] ?? 0) + 1;
        }

        return [
            'totalServices' => $totalServices,
            'totalClients' => $totalClients,
            'averageRating' => $averageRating,
            'categoryStats' => $categoryStats
        ];
    }
}