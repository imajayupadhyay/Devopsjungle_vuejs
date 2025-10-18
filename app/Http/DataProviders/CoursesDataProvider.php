<?php

namespace App\Http\DataProviders;

class CoursesDataProvider
{
    /**
     * Get all available courses
     */
    public static function getCourses(): array
    {
        return [
            [
                'id' => 'aws-complete-guide',
                'title' => 'Complete AWS Cloud Practitioner & Solutions Architect',
                'category' => 'aws',
                'level' => 'intermediate',
                'instructor' => 'John Mitchell, AWS Solutions Architect',
                'description' => 'Master AWS from basics to advanced with hands-on labs, real-world projects, and certification preparation.',
                'duration' => 45,
                'lessons' => 120,
                'students' => 85000,
                'rating' => 4.9,
                'reviews' => 12500,
                'price' => 129,
                'originalPrice' => 199,
                'language' => 'English',
                'certificate' => true,
                'bestseller' => true,
                'featured' => true,
                'lastUpdated' => '2024-12-01',
                'skills' => ['EC2', 'S3', 'RDS', 'Lambda', 'CloudFormation', 'VPC', 'IAM', 'Route53']
            ],
            [
                'id' => 'terraform-complete-guide',
                'title' => 'Terraform: Infrastructure as Code Complete Guide',
                'category' => 'terraform',
                'level' => 'intermediate',
                'instructor' => 'Alex Thompson, Infrastructure Expert',
                'description' => 'Master Terraform for AWS, Azure, and GCP. Learn best practices, modules, and enterprise patterns.',
                'duration' => 35,
                'lessons' => 90,
                'students' => 45000,
                'rating' => 4.9,
                'reviews' => 7200,
                'price' => 119,
                'originalPrice' => 169,
                'language' => 'English',
                'certificate' => true,
                'bestseller' => true,
                'featured' => true,
                'lastUpdated' => '2024-12-08',
                'skills' => ['HCL', 'Providers', 'Modules', 'State Management', 'Terraform Cloud', 'Multi-cloud', 'Best Practices']
            ],
            [
                'id' => 'docker-complete-guide',
                'title' => 'Docker & Container Technology Complete Guide',
                'category' => 'docker',
                'level' => 'beginner',
                'instructor' => 'Tom Anderson, Container Architect',
                'description' => 'Master Docker from basics to production deployment with best practices and real-world projects.',
                'duration' => 32,
                'lessons' => 85,
                'students' => 92000,
                'rating' => 4.9,
                'reviews' => 14500,
                'price' => 89,
                'originalPrice' => 129,
                'language' => 'English',
                'certificate' => true,
                'bestseller' => true,
                'featured' => true,
                'lastUpdated' => '2024-12-12',
                'skills' => ['Docker Engine', 'Dockerfile', 'Docker Compose', 'Networking', 'Volumes', 'Registry', 'Security']
            ],
            [
                'id' => 'kubernetes-mastery',
                'title' => 'Kubernetes Mastery: From Zero to Production',
                'category' => 'kubernetes',
                'level' => 'advanced',
                'instructor' => 'Sarah Kim, Kubernetes Expert',
                'description' => 'Complete Kubernetes course covering deployment, scaling, monitoring, and production best practices.',
                'duration' => 40,
                'lessons' => 95,
                'students' => 38000,
                'rating' => 4.8,
                'reviews' => 5600,
                'price' => 149,
                'originalPrice' => 199,
                'language' => 'English',
                'certificate' => true,
                'bestseller' => false,
                'featured' => true,
                'lastUpdated' => '2024-11-25',
                'skills' => ['Pods', 'Services', 'Deployments', 'ConfigMaps', 'Secrets', 'Ingress', 'Monitoring', 'RBAC']
            ],
            [
                'id' => 'azure-fundamentals',
                'title' => 'Microsoft Azure Fundamentals Complete Course',
                'category' => 'azure',
                'level' => 'beginner',
                'instructor' => 'Rachel Martinez, Azure Consultant',
                'description' => 'Learn Azure from scratch with hands-on projects and prepare for AZ-900 certification.',
                'duration' => 28,
                'lessons' => 75,
                'students' => 67000,
                'rating' => 4.7,
                'reviews' => 9800,
                'price' => 99,
                'originalPrice' => 149,
                'language' => 'English',
                'certificate' => true,
                'bestseller' => true,
                'featured' => false,
                'lastUpdated' => '2024-12-15',
                'skills' => ['Azure Portal', 'Virtual Machines', 'Storage', 'Networking', 'Azure AD', 'Cost Management']
            ],
            [
                'id' => 'devops-fundamentals',
                'title' => 'DevOps Fundamentals: CI/CD, Automation & Monitoring',
                'category' => 'devops',
                'level' => 'intermediate',
                'instructor' => 'Mark Johnson, DevOps Engineer',
                'description' => 'Learn DevOps practices, tools, and methodologies for modern software delivery.',
                'duration' => 38,
                'lessons' => 88,
                'students' => 52000,
                'rating' => 4.8,
                'reviews' => 7800,
                'price' => 109,
                'originalPrice' => 159,
                'language' => 'English',
                'certificate' => true,
                'bestseller' => false,
                'featured' => true,
                'lastUpdated' => '2024-11-30',
                'skills' => ['Git', 'Jenkins', 'Docker', 'Ansible', 'Monitoring', 'CI/CD', 'Infrastructure as Code']
            ]
        ];
    }

    /**
     * Get course categories
     */
    public static function getCategories(): array
    {
        return [
            ['id' => 'all', 'name' => 'All Categories', 'icon' => 'fas fa-th-large'],
            ['id' => 'aws', 'name' => 'Amazon AWS', 'icon' => 'fab fa-aws'],
            ['id' => 'azure', 'name' => 'Microsoft Azure', 'icon' => 'fab fa-microsoft'],
            ['id' => 'docker', 'name' => 'Docker', 'icon' => 'fab fa-docker'],
            ['id' => 'kubernetes', 'name' => 'Kubernetes', 'icon' => 'fas fa-dharmachakra'],
            ['id' => 'terraform', 'name' => 'Terraform', 'icon' => 'fas fa-layer-group'],
            ['id' => 'devops', 'name' => 'DevOps', 'icon' => 'fas fa-cogs']
        ];
    }

    /**
     * Get course levels
     */
    public static function getLevels(): array
    {
        return [
            ['id' => 'all', 'name' => 'All Levels'],
            ['id' => 'beginner', 'name' => 'Beginner'],
            ['id' => 'intermediate', 'name' => 'Intermediate'],
            ['id' => 'advanced', 'name' => 'Advanced']
        ];
    }

    /**
     * Get course by ID
     */
    public static function getCourseById(string $courseId): ?array
    {
        $courses = self::getCourses();

        foreach ($courses as $course) {
            if ($course['id'] === $courseId) {
                return $course;
            }
        }

        return null;
    }

    /**
     * Get featured courses
     */
    public static function getFeaturedCourses(): array
    {
        $allCourses = self::getCourses();
        return array_filter($allCourses, fn($course) => $course['featured'] === true);
    }

    /**
     * Get bestseller courses
     */
    public static function getBestsellerCourses(): array
    {
        $allCourses = self::getCourses();
        return array_filter($allCourses, fn($course) => $course['bestseller'] === true);
    }

    /**
     * Get related courses (same category, excluding current)
     */
    public static function getRelatedCourses(string $courseId, int $limit = 3): array
    {
        $currentCourse = self::getCourseById($courseId);

        if (!$currentCourse) {
            return [];
        }

        $allCourses = self::getCourses();

        // Filter courses from same category, excluding current course
        $relatedCourses = array_filter($allCourses, function($course) use ($currentCourse, $courseId) {
            return $course['category'] === $currentCourse['category'] && $course['id'] !== $courseId;
        });

        // Sort by rating and take the specified limit
        usort($relatedCourses, fn($a, $b) => $b['rating'] <=> $a['rating']);

        return array_slice($relatedCourses, 0, $limit);
    }

    /**
     * Get all data for the courses index page
     */
    public static function getIndexData(): array
    {
        return [
            'courses' => self::getCourses(),
            'categories' => self::getCategories(),
            'levels' => self::getLevels(),
            'featuredCourses' => self::getFeaturedCourses(),
            'bestsellerCourses' => self::getBestsellerCourses()
        ];
    }

    /**
     * Get all data for the course detail page
     */
    public static function getDetailPageData(string $courseId): array
    {
        $course = self::getCourseById($courseId);

        if (!$course) {
            return [];
        }

        return [
            'course' => $course,
            'relatedCourses' => self::getRelatedCourses($courseId)
        ];
    }
}