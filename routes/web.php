<?php

use App\Http\Controllers\SupportController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BlogController;
use App\Http\DataProviders\PracticeLabsDataProvider;
use App\Http\DataProviders\ExamLabsDataProvider;
use App\Http\DataProviders\LabStepsDataProvider;
use App\Http\DataProviders\DumpsDataProvider;
use App\Http\DataProviders\DumpDetailDataProvider;
use App\Http\DataProviders\CoursesDataProvider;
use App\Http\DataProviders\ServicesDataProvider;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home/Index', [
        'message' => 'Welcome to DevOpsJungle!'
    ]);
});

Route::get('/support', [SupportController::class, 'index'])->name('support');
Route::post('/support', [SupportController::class, 'store'])->name('support.store');

Route::post('/signup', [StudentController::class, 'store'])->name('signup.store');
Route::post('/login', [StudentController::class, 'login'])->name('login');
Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [StudentController::class, 'profile'])->name('profile');
    Route::put('/profile', [StudentController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar', [StudentController::class, 'uploadAvatar'])->name('profile.avatar');
});

Route::get('/dumps', function () {
    return Inertia::render('Dumps/Index', DumpsDataProvider::getIndexData());
})->name('dumps');

Route::get('/dumps/{id}', function ($id) {
    $data = DumpDetailDataProvider::getDetailPageData($id);

    if (empty($data)) {
        abort(404);
    }

    return Inertia::render('Dumps/Detail', $data);
})->name('dumps.show');

Route::get('/courses', function () {
    return Inertia::render('Courses/Index', CoursesDataProvider::getIndexData());
})->name('courses');

Route::get('/courses/{id}', function ($id) {
    $data = CoursesDataProvider::getDetailPageData($id);

    if (empty($data)) {
        abort(404);
    }

    return Inertia::render('Courses/Detail', $data);
})->name('courses.show');

Route::get('/services', function () {
    return Inertia::render('Services/Index', ServicesDataProvider::getIndexData());
})->name('services');

Route::get('/services/{id}', function ($id) {
    $data = ServicesDataProvider::getDetailPageData($id);

    if (empty($data)) {
        abort(404);
    }

    return Inertia::render('Services/Detail', $data);
})->name('services.show');

Route::get('/practice-labs', function () {
    return Inertia::render('PracticeLabs/Index', PracticeLabsDataProvider::getIndexData());
})->name('practice-labs');

Route::get('/practice-labs/{examId}', function ($examId) {
    $data = ExamLabsDataProvider::getExamLabsData($examId);

    if (empty($data)) {
        abort(404);
    }

    return Inertia::render('PracticeLabs/ExamLabs', $data);
})->name('practice-labs.exam');

Route::get('/practice-labs/{examId}/{labId}', function ($examId, $labId) {
    $data = LabStepsDataProvider::getLabStepsData($examId, $labId);

    if (empty($data)) {
        abort(404);
    }

    return Inertia::render('PracticeLabs/LabSteps', $data);
})->name('practice-labs.lab');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs');
Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
