<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group.
|
*/

Route::prefix('admin')->name('admin.')->group(function () {

    // Admin Login Routes (guest:admin middleware)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/devops-secure-login', [AuthController::class, 'showLoginForm'])->name('login');
        Route::post('/devops-secure-login', [AuthController::class, 'login'])->name('login.store');
    });

    // Admin Protected Routes (auth:admin + admin middleware)
    Route::middleware(['auth:admin', 'admin'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        // User Management Routes
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/toggle-admin', [UserController::class, 'toggleAdmin'])->name('users.toggle-admin');

        // Student Management Routes
        Route::get('/students', [StudentController::class, 'index'])->name('students.index');
        Route::post('/students', [StudentController::class, 'store'])->name('students.store');
        Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');
        Route::post('/students/{student}/toggle-status', [StudentController::class, 'toggleStatus'])->name('students.toggle-status');
        Route::post('/students/{student}/suspend', [StudentController::class, 'suspend'])->name('students.suspend');
        Route::post('/students/{student}/activate', [StudentController::class, 'activate'])->name('students.activate');

        // Support Ticket Routes
        Route::get('/support', [SupportTicketController::class, 'index'])->name('support.index');
        Route::post('/support/{ticket}/status', [SupportTicketController::class, 'updateStatus'])->name('support.update-status');
        Route::post('/support/{ticket}/priority', [SupportTicketController::class, 'updatePriority'])->name('support.update-priority');
        Route::delete('/support/{ticket}', [SupportTicketController::class, 'destroy'])->name('support.destroy');

        // Blog Management Routes
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
        Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::match(['PUT', 'POST'], '/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

        // Blog Actions
        Route::post('/blogs/{blog}/publish', [BlogController::class, 'publish'])->name('blogs.publish');
        Route::post('/blogs/{blog}/unpublish', [BlogController::class, 'unpublish'])->name('blogs.unpublish');
        Route::post('/blogs/{blog}/schedule', [BlogController::class, 'schedule'])->name('blogs.schedule');
        Route::post('/blogs/{blog}/toggle-featured', [BlogController::class, 'toggleFeatured'])->name('blogs.toggle-featured');
        Route::post('/blogs/{blog}/duplicate', [BlogController::class, 'duplicate'])->name('blogs.duplicate');
        Route::post('/blogs/bulk-action', [BlogController::class, 'bulkAction'])->name('blogs.bulk-action');

        // Category Management Routes
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::patch('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::patch('/categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
        Route::post('/categories/sort-order', [CategoryController::class, 'updateSortOrder'])->name('categories.sort-order');
        Route::post('/categories/bulk-action', [CategoryController::class, 'bulkAction'])->name('categories.bulk-action');

        // Tag Management Routes
        Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
        Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
        Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
        Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');
        Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
        Route::patch('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
        Route::patch('/tags/{tag}/toggle-status', [TagController::class, 'toggleStatus'])->name('tags.toggle-status');
        Route::post('/tags/bulk-action', [TagController::class, 'bulkAction'])->name('tags.bulk-action');

        // Tag API Routes for autocomplete
        Route::get('/tags/api/popular', [TagController::class, 'popular'])->name('tags.popular');
        Route::get('/tags/api/search', [TagController::class, 'search'])->name('tags.search');

        // Image Upload Route for TinyMCE
        Route::post('/upload-image', [BlogController::class, 'uploadImage'])->name('upload-image');
    });
});