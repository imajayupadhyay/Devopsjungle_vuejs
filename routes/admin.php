<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SupportTicketController;

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
    });
});