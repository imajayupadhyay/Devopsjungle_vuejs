<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamTopic;
use Illuminate\Support\Str;

class ExamTopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $topics = [
            // Cloud Computing Topics
            ['name' => 'Compute', 'description' => 'Virtual machines, containers, and serverless computing'],
            ['name' => 'Storage', 'description' => 'Object storage, block storage, and file storage solutions'],
            ['name' => 'Database', 'description' => 'Relational and NoSQL database services'],
            ['name' => 'Network & Security', 'description' => 'VPC, load balancing, and network security'],
            ['name' => 'Management & Governance', 'description' => 'Monitoring, logging, and cost management'],
            ['name' => 'Identity & Access Management', 'description' => 'Authentication, authorization, and access control'],
            ['name' => 'Application Integration', 'description' => 'Messaging, queuing, and event-driven architecture'],
            ['name' => 'Analytics', 'description' => 'Data warehousing, big data, and analytics services'],
            ['name' => 'Machine Learning & AI', 'description' => 'ML models, AI services, and data science tools'],
            ['name' => 'DevOps & CI/CD', 'description' => 'Continuous integration and deployment pipelines'],

            // Kubernetes & Container Topics
            ['name' => 'Cluster Architecture', 'description' => 'Kubernetes cluster components and architecture'],
            ['name' => 'Workloads & Scheduling', 'description' => 'Pods, deployments, and scheduling'],
            ['name' => 'Services & Networking', 'description' => 'Service discovery, load balancing, and ingress'],
            ['name' => 'Configuration & Secrets', 'description' => 'ConfigMaps, secrets, and environment variables'],
            ['name' => 'Storage & Volumes', 'description' => 'Persistent volumes and storage classes'],
            ['name' => 'Monitoring & Logging', 'description' => 'Observability, metrics, and log aggregation'],
            ['name' => 'Security & Compliance', 'description' => 'RBAC, pod security policies, and compliance'],
            ['name' => 'Troubleshooting & Optimization', 'description' => 'Debugging, performance tuning, and optimization'],

            // General Topics
            ['name' => 'High Availability', 'description' => 'Designing fault-tolerant and resilient systems'],
            ['name' => 'Disaster Recovery', 'description' => 'Backup, restore, and business continuity'],
            ['name' => 'Cost Optimization', 'description' => 'Resource optimization and cost management strategies'],
            ['name' => 'Migration Planning', 'description' => 'Cloud migration strategies and planning'],
        ];

        foreach ($topics as $topic) {
            ExamTopic::updateOrCreate(
                ['slug' => Str::slug($topic['name'])],
                array_merge($topic, [
                    'slug' => Str::slug($topic['name']),
                    'is_active' => true,
                ])
            );
        }
    }
}
