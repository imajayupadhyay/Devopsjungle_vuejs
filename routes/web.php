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

Route::get('/courses', function () {
    return Inertia::render('Courses/Index');
})->name('courses');

Route::get('/courses/{id}', function ($id) {
    // Sample course data - in a real app, this would come from a database
    $courses = [
        'aws-complete-guide' => [
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
        'terraform-complete-guide' => [
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
        'docker-complete-guide' => [
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
        ]
    ];

    // Get course data
    $course = $courses[$id] ?? null;

    if (!$course) {
        abort(404);
    }

    // Get related courses (same category, excluding current)
    $relatedCourses = collect($courses)
        ->filter(function ($relatedCourse) use ($course) {
            return $relatedCourse['category'] === $course['category'] && $relatedCourse['id'] !== $course['id'];
        })
        ->take(3)
        ->values()
        ->toArray();

    return Inertia::render('Courses/Detail', [
        'course' => $course,
        'relatedCourses' => $relatedCourses
    ]);
})->name('courses.show');
