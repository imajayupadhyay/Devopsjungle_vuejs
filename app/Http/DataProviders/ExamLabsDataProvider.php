<?php

namespace App\Http\DataProviders;

class ExamLabsDataProvider
{
    /**
     * Get labs for a specific exam
     */
    public static function getLabsForExam(string $examId): array
    {
        $labsData = [
            'aws-saa-c03' => [
                [
                    'id' => 1,
                    'title' => 'Setting up VPC with Public and Private Subnets',
                    'description' => 'Learn to create a secure VPC architecture with public and private subnets, NAT gateways, and proper routing.',
                    'difficulty' => 'Intermediate',
                    'duration' => '45 mins',
                    'steps' => 8,
                    'rating' => 4.8,
                    'category' => 'networking',
                    'icon' => 'fas fa-network-wired',
                    'skills' => ['VPC', 'Subnets', 'NAT Gateway', 'Route Tables'],
                    'status' => 'completed'
                ],
                [
                    'id' => 2,
                    'title' => 'Deploying Auto Scaling Web Application',
                    'description' => 'Deploy a highly available web application using EC2 Auto Scaling Groups and Application Load Balancer.',
                    'difficulty' => 'Advanced',
                    'duration' => '60 mins',
                    'steps' => 12,
                    'rating' => 4.9,
                    'category' => 'compute',
                    'icon' => 'fas fa-server',
                    'skills' => ['EC2', 'Auto Scaling', 'Load Balancer', 'CloudWatch'],
                    'status' => 'in-progress'
                ],
                [
                    'id' => 3,
                    'title' => 'S3 Bucket Security and Encryption',
                    'description' => 'Implement S3 bucket security best practices including encryption, access policies, and versioning.',
                    'difficulty' => 'Beginner',
                    'duration' => '30 mins',
                    'steps' => 6,
                    'rating' => 4.7,
                    'category' => 'storage',
                    'icon' => 'fas fa-database',
                    'skills' => ['S3', 'IAM', 'Encryption', 'Bucket Policies'],
                    'status' => 'not-started'
                ],
                [
                    'id' => 4,
                    'title' => 'RDS Multi-AZ Setup with Read Replicas',
                    'description' => 'Configure RDS for high availability with Multi-AZ deployment and read replicas for performance.',
                    'difficulty' => 'Intermediate',
                    'duration' => '50 mins',
                    'steps' => 10,
                    'rating' => 4.6,
                    'category' => 'database',
                    'icon' => 'fas fa-database',
                    'skills' => ['RDS', 'Multi-AZ', 'Read Replicas', 'Backup'],
                    'status' => 'not-started'
                ],
                [
                    'id' => 5,
                    'title' => 'Lambda Function with API Gateway',
                    'description' => 'Create serverless applications using Lambda functions triggered by API Gateway.',
                    'difficulty' => 'Advanced',
                    'duration' => '55 mins',
                    'steps' => 9,
                    'rating' => 4.8,
                    'category' => 'compute',
                    'icon' => 'fas fa-bolt',
                    'skills' => ['Lambda', 'API Gateway', 'Serverless', 'IAM Roles'],
                    'status' => 'not-started'
                ]
            ],
            'aws-soa-c02' => [
                [
                    'id' => 1,
                    'title' => 'CloudWatch Monitoring and Alerting',
                    'description' => 'Set up comprehensive monitoring with CloudWatch metrics, alarms, and dashboards.',
                    'difficulty' => 'Intermediate',
                    'duration' => '40 mins',
                    'steps' => 8,
                    'rating' => 4.7,
                    'category' => 'monitoring',
                    'icon' => 'fas fa-chart-line',
                    'skills' => ['CloudWatch', 'Metrics', 'Alarms', 'Dashboards'],
                    'status' => 'not-started'
                ],
                [
                    'id' => 2,
                    'title' => 'Systems Manager Patch Management',
                    'description' => 'Automate patch management for EC2 instances using AWS Systems Manager.',
                    'difficulty' => 'Advanced',
                    'duration' => '45 mins',
                    'steps' => 10,
                    'rating' => 4.5,
                    'category' => 'deployment',
                    'icon' => 'fas fa-tools',
                    'skills' => ['Systems Manager', 'Patch Manager', 'EC2', 'Automation'],
                    'status' => 'not-started'
                ]
            ],
            'az-900' => [
                [
                    'id' => 1,
                    'title' => 'Creating Virtual Machines in Azure',
                    'description' => 'Learn to create and configure virtual machines in Microsoft Azure.',
                    'difficulty' => 'Beginner',
                    'duration' => '35 mins',
                    'steps' => 7,
                    'rating' => 4.6,
                    'category' => 'compute',
                    'icon' => 'fas fa-desktop',
                    'skills' => ['Virtual Machines', 'Azure Portal', 'Networking', 'Storage'],
                    'status' => 'not-started'
                ],
                [
                    'id' => 2,
                    'title' => 'Azure Storage Account Management',
                    'description' => 'Create and manage Azure storage accounts with different access tiers.',
                    'difficulty' => 'Beginner',
                    'duration' => '25 mins',
                    'steps' => 5,
                    'rating' => 4.4,
                    'category' => 'storage',
                    'icon' => 'fas fa-hdd',
                    'skills' => ['Storage Accounts', 'Blob Storage', 'Access Tiers', 'Security'],
                    'status' => 'not-started'
                ]
            ],
            'cka' => [
                [
                    'id' => 1,
                    'title' => 'Kubernetes Cluster Setup',
                    'description' => 'Set up a multi-node Kubernetes cluster from scratch using kubeadm.',
                    'difficulty' => 'Advanced',
                    'duration' => '90 mins',
                    'steps' => 15,
                    'rating' => 4.9,
                    'category' => 'deployment',
                    'icon' => 'fas fa-server',
                    'skills' => ['kubeadm', 'Cluster Setup', 'Networking', 'Security'],
                    'status' => 'not-started'
                ],
                [
                    'id' => 2,
                    'title' => 'Pod Scheduling and Node Affinity',
                    'description' => 'Configure advanced pod scheduling with node affinity and anti-affinity rules.',
                    'difficulty' => 'Advanced',
                    'duration' => '60 mins',
                    'steps' => 12,
                    'rating' => 4.7,
                    'category' => 'compute',
                    'icon' => 'fas fa-cubes',
                    'skills' => ['Pod Scheduling', 'Node Affinity', 'Taints', 'Tolerations'],
                    'status' => 'not-started'
                ]
            ]
        ];

        return $labsData[$examId] ?? [];
    }

    /**
     * Get exam data by ID (simplified version)
     */
    public static function getExamById(string $examId): ?array
    {
        return PracticeLabsDataProvider::getExamById($examId);
    }

    /**
     * Get all data for the exam labs page
     */
    public static function getExamLabsData(string $examId): array
    {
        $exam = self::getExamById($examId);

        if (!$exam) {
            return [];
        }

        $labs = self::getLabsForExam($examId);

        return [
            'exam' => $exam,
            'labs' => $labs
        ];
    }

    /**
     * Get lab statistics for an exam
     */
    public static function getLabStatistics(string $examId): array
    {
        $labs = self::getLabsForExam($examId);

        $totalLabs = count($labs);
        $completedLabs = count(array_filter($labs, fn($lab) => $lab['status'] === 'completed'));
        $inProgressLabs = count(array_filter($labs, fn($lab) => $lab['status'] === 'in-progress'));

        $totalDuration = array_reduce($labs, function($carry, $lab) {
            $duration = (int) explode(' ', $lab['duration'])[0];
            return $carry + $duration;
        }, 0);

        return [
            'total' => $totalLabs,
            'completed' => $completedLabs,
            'inProgress' => $inProgressLabs,
            'notStarted' => $totalLabs - $completedLabs - $inProgressLabs,
            'totalDuration' => $totalDuration,
            'completionRate' => $totalLabs > 0 ? round(($completedLabs / $totalLabs) * 100) : 0
        ];
    }
}