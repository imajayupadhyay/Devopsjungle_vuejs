<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;

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
    });
});