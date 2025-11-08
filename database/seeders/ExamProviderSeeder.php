<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExamProvider;

class ExamProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = [
            [
                'name' => 'Amazon AWS',
                'slug' => 'aws',
                'icon' => 'fab fa-aws',
                'description' => 'Cloud computing certifications',
                'gradient_color' => 'linear-gradient(135deg, #FF9900 0%, #FF6600 100%)',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Microsoft Azure',
                'slug' => 'azure',
                'icon' => 'fab fa-microsoft',
                'description' => 'Azure cloud solutions',
                'gradient_color' => 'linear-gradient(135deg, #0078D4 0%, #005A9E 100%)',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Google Cloud',
                'slug' => 'gcp',
                'icon' => 'fab fa-google',
                'description' => 'GCP engineering certifications',
                'gradient_color' => 'linear-gradient(135deg, #4285F4 0%, #34A853 50%, #FBBC04 100%)',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Kubernetes',
                'slug' => 'kubernetes',
                'icon' => 'fas fa-dharmachakra',
                'description' => 'Container orchestration',
                'gradient_color' => 'linear-gradient(135deg, #326CE5 0%, #1A73E8 100%)',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Docker',
                'slug' => 'docker',
                'icon' => 'fab fa-docker',
                'description' => 'Containerization platform',
                'gradient_color' => 'linear-gradient(135deg, #2496ED 0%, #0DB7ED 100%)',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Linux',
                'slug' => 'linux',
                'icon' => 'fab fa-linux',
                'description' => 'Linux system administration',
                'gradient_color' => 'linear-gradient(135deg, #FCC624 0%, #F68A1E 100%)',
                'is_active' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($providers as $provider) {
            ExamProvider::updateOrCreate(
                ['slug' => $provider['slug']],
                $provider
            );
        }
    }
}
