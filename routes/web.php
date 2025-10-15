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
