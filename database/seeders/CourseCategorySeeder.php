<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CourseCategory;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Amazon AWS',
                'slug' => 'aws',
                'icon' => 'fab fa-aws',
                'description' => 'AWS cloud courses',
                'color' => 'linear-gradient(135deg, #FF9900 0%, #FF6600 100%)',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Microsoft Azure',
                'slug' => 'azure',
                'icon' => 'fab fa-microsoft',
                'description' => 'Azure cloud training',
                'color' => 'linear-gradient(135deg, #0078D4 0%, #005A9E 100%)',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Google Cloud',
                'slug' => 'gcp',
                'icon' => 'fab fa-google',
                'description' => 'GCP certifications',
                'color' => 'linear-gradient(135deg, #4285F4 0%, #34A853 50%, #FBBC04 100%)',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Docker',
                'slug' => 'docker',
                'icon' => 'fab fa-docker',
                'description' => 'Container technology',
                'color' => 'linear-gradient(135deg, #2496ED 0%, #0DB7ED 100%)',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Kubernetes',
                'slug' => 'kubernetes',
                'icon' => 'fas fa-dharmachakra',
                'description' => 'Container orchestration',
                'color' => 'linear-gradient(135deg, #326CE5 0%, #1A73E8 100%)',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Terraform',
                'slug' => 'terraform',
                'icon' => 'fas fa-layer-group',
                'description' => 'Infrastructure as Code',
                'color' => 'linear-gradient(135deg, #7B42BC 0%, #5C4EE5 100%)',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'icon' => 'fas fa-cogs',
                'description' => 'DevOps practices',
                'color' => 'linear-gradient(135deg, #10B981 0%, #059669 100%)',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'CI/CD',
                'slug' => 'cicd',
                'icon' => 'fas fa-code-branch',
                'description' => 'Continuous Integration',
                'color' => 'linear-gradient(135deg, #F59E0B 0%, #D97706 100%)',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Monitoring',
                'slug' => 'monitoring',
                'icon' => 'fas fa-chart-line',
                'description' => 'Infrastructure monitoring',
                'color' => 'linear-gradient(135deg, #EF4444 0%, #DC2626 100%)',
                'is_active' => true,
                'sort_order' => 9,
            ],
        ];

        foreach ($categories as $category) {
            CourseCategory::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
