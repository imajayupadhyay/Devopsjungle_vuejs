<?php

use App\Http\Controllers\SupportController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'message' => 'Welcome to DevOpsJungle!'
    ]);
});

Route::get('/support', [SupportController::class, 'index'])->name('support');
Route::post('/support', [SupportController::class, 'store'])->name('support.store');

Route::get('/dumps', function () {
    return Inertia::render('Dumps/Index');
})->name('dumps');

Route::get('/dumps/{id}', function ($id) {
    // Sample exam data - in a real app, this would come from a database
    $exams = [
        'aws-saa-c03' => [
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
        'aws-soa-c02' => [
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
            'prerequisites' => ['1+ years AWS operations experience']
        ],
        'az-900' => [
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
            'badge' => 'Entry Level'
        ]
    ];

    // Get exam data
    $exam = $exams[$id] ?? null;

    if (!$exam) {
        abort(404);
    }

    // Get related exams (same provider, excluding current)
    $relatedExams = collect($exams)
        ->filter(function ($relatedExam) use ($exam) {
            return $relatedExam['provider'] === $exam['provider'] && $relatedExam['id'] !== $exam['id'];
        })
        ->take(3)
        ->values()
        ->toArray();

    return Inertia::render('Dumps/Detail', [
        'exam' => $exam,
        'relatedExams' => $relatedExams
    ]);
})->name('dumps.show');
