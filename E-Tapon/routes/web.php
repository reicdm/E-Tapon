<?php

use App\Http\Controllers\CollectorAuthController;
use App\Http\Controllers\CollectorDashboardController;
use App\Http\Controllers\ResidentAuthController;
use App\Http\Controllers\ResidentDashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return "<h1>Successful!<h1>";
});

// SELECT ROLE
Route::get('/select', function () {
    return view('select_role');
});

// RESIDENT ROUTES
Route::prefix('resident')->group(function () {
    // AUTH
    Route::get('greet', function () {
        return view('auth.resident.greet');
    });
    Route::get('/login', [ResidentAuthController::class, 'showLoginForm'])->name('resident.login');
    Route::post('/login', [ResidentAuthController::class, 'login'])->name('resident.login.submit');
    Route::get('/register', [ResidentAuthController::class, 'showRegisterForm'])->name('resident.register');
    Route::post('/register', [ResidentAuthController::class, 'register'])->name('resident.register.submit');
    Route::get('/forgot', [ResidentAuthController::class, 'showForgotForm'])->name('resident.forgot');
    Route::post('/logout', [ResidentAuthController::class, 'logout'])->name('resident.logout');

    // DASHBOARD WITH VERIFICATION
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [ResidentDashboardController::class, 'dashboard'])->name('resident.dashboard');
    });
});

// COLLECTOR ROUTES
Route::prefix('collector')->group(function () {
    // AUTH
    Route::get('/greet', function () {
        return view('auth.collector.greet');
    });
    Route::get('/login', [CollectorAuthController::class, 'showLoginForm'])->name('collector.login');
    Route::post('/login', [CollectorAuthController::class, 'login'])->name('collector.login.submit');
    Route::get('/forgot', [CollectorAuthController::class, 'showForgotForm'])->name('collector.forgot');
    Route::post('/logout', [CollectorAuthController::class, 'logout'])->name('collector.logout');

    // DASHBOARD WITH VERIFICATION
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [CollectorDashboardController::class, 'dashboard'])->name('collector.dashboard');
    });
});
