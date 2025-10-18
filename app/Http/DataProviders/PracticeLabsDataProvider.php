<?php

namespace App\Http\DataProviders;

class PracticeLabsDataProvider
{
    /**
     * Get all available exams for practice labs
     */
    public static function getExams(): array
    {
        return [
            [
                'id' => 'aws-saa-c03',
                'title' => 'AWS Certified Solutions Architect - Associate',
                'code' => 'SAA-C03',
                'provider' => 'aws',
                'icon' => 'fab fa-aws',
                'difficulty' => 'Intermediate',
                'labCount' => 45,
                'description' => 'Master AWS architecture patterns with hands-on labs covering EC2, S3, RDS, and more.',
                'topics' => ['EC2 & Auto Scaling', 'S3 & Storage', 'RDS & DynamoDB', 'VPC & Networking', 'IAM & Security', 'Lambda & Serverless'],
                'badge' => 'Popular'
            ],
            [
                'id' => 'aws-soa-c02',
                'title' => 'AWS Certified SysOps Administrator - Associate',
                'code' => 'SOA-C02',
                'provider' => 'aws',
                'icon' => 'fab fa-aws',
                'difficulty' => 'Intermediate',
                'labCount' => 38,
                'description' => 'Practice AWS operations and system administration with real-world scenarios.',
                'topics' => ['CloudWatch & Monitoring', 'Systems Manager', 'Cost Optimization', 'Security & Compliance'],
                'badge' => null
            ],
            [
                'id' => 'az-900',
                'title' => 'Microsoft Azure Fundamentals',
                'code' => 'AZ-900',
                'provider' => 'azure',
                'icon' => 'fab fa-microsoft',
                'difficulty' => 'Beginner',
                'labCount' => 25,
                'description' => 'Get started with Azure through interactive labs covering core cloud concepts.',
                'topics' => ['Azure Portal', 'Virtual Machines', 'Storage Accounts', 'Azure AD', 'Cost Management'],
                'badge' => 'New'
            ],
            [
                'id' => 'az-104',
                'title' => 'Microsoft Azure Administrator',
                'code' => 'AZ-104',
                'provider' => 'azure',
                'icon' => 'fab fa-microsoft',
                'difficulty' => 'Intermediate',
                'labCount' => 42,
                'description' => 'Advanced Azure administration labs with focus on resource management and security.',
                'topics' => ['Resource Groups', 'Virtual Networks', 'Azure AD', 'Backup & Recovery', 'Monitoring'],
                'badge' => 'Popular'
            ],
            [
                'id' => 'gcp-ace',
                'title' => 'Google Cloud Associate Cloud Engineer',
                'code' => 'ACE',
                'provider' => 'gcp',
                'icon' => 'fab fa-google',
                'difficulty' => 'Intermediate',
                'labCount' => 35,
                'description' => 'Practice GCP fundamentals with hands-on labs in Compute Engine, Cloud Storage, and more.',
                'topics' => ['Compute Engine', 'Cloud Storage', 'Cloud SQL', 'VPC Networks', 'IAM & Security'],
                'badge' => null
            ],
            [
                'id' => 'cka',
                'title' => 'Certified Kubernetes Administrator',
                'code' => 'CKA',
                'provider' => 'kubernetes',
                'icon' => 'fas fa-dharmachakra',
                'difficulty' => 'Advanced',
                'labCount' => 50,
                'description' => 'Master Kubernetes administration with performance-based labs and real scenarios.',
                'topics' => ['Cluster Architecture', 'Workloads & Scheduling', 'Services & Networking', 'Storage', 'Troubleshooting'],
                'badge' => 'Expert'
            ],
            [
                'id' => 'ckad',
                'title' => 'Certified Kubernetes Application Developer',
                'code' => 'CKAD',
                'provider' => 'kubernetes',
                'icon' => 'fas fa-dharmachakra',
                'difficulty' => 'Intermediate',
                'labCount' => 40,
                'description' => 'Develop and deploy applications on Kubernetes with practical lab exercises.',
                'topics' => ['Core Concepts', 'Multi-Container Pods', 'Pod Design', 'Configuration', 'Observability'],
                'badge' => null
            ],
            [
                'id' => 'docker-dca',
                'title' => 'Docker Certified Associate',
                'code' => 'DCA',
                'provider' => 'docker',
                'icon' => 'fab fa-docker',
                'difficulty' => 'Intermediate',
                'labCount' => 30,
                'description' => 'Learn Docker containerization with hands-on labs covering all exam objectives.',
                'topics' => ['Container Fundamentals', 'Image Management', 'Orchestration', 'Storage & Volumes', 'Networking', 'Security'],
                'badge' => null
            ]
        ];
    }

    /**
     * Get exam categories for filtering
     */
    public static function getCategories(): array
    {
        return [
            ['id' => 'all', 'name' => 'All Exams', 'icon' => 'fas fa-th-large'],
            ['id' => 'aws', 'name' => 'AWS', 'icon' => 'fab fa-aws'],
            ['id' => 'azure', 'name' => 'Azure', 'icon' => 'fab fa-microsoft'],
            ['id' => 'gcp', 'name' => 'Google Cloud', 'icon' => 'fab fa-google'],
            ['id' => 'kubernetes', 'name' => 'Kubernetes', 'icon' => 'fas fa-dharmachakra'],
            ['id' => 'docker', 'name' => 'Docker', 'icon' => 'fab fa-docker']
        ];
    }

    /**
     * Get features to highlight about practice labs
     */
    public static function getFeatures(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Real Environment',
                'description' => 'Practice in actual cloud environments, not simulations',
                'icon' => 'fas fa-cloud',
                'color' => 'bg-blue-500'
            ],
            [
                'id' => 2,
                'title' => 'Step-by-Step',
                'description' => 'Guided instructions with detailed explanations',
                'icon' => 'fas fa-list-ol',
                'color' => 'bg-green-500'
            ],
            [
                'id' => 3,
                'title' => 'Instant Feedback',
                'description' => 'Get immediate results and progress tracking',
                'icon' => 'fas fa-check-circle',
                'color' => 'bg-purple-500'
            ],
            [
                'id' => 4,
                'title' => 'Exam Focused',
                'description' => 'Labs designed to match certification requirements',
                'icon' => 'fas fa-trophy',
                'color' => 'bg-orange-500'
            ]
        ];
    }

    /**
     * Get a specific exam by ID
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
     * Get all data for the practice labs index page
     */
    public static function getIndexData(): array
    {
        return [
            'exams' => self::getExams(),
            'categories' => self::getCategories(),
            'features' => self::getFeatures()
        ];
    }
}