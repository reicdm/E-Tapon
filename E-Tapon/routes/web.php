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


// RESIDENT ROUTES
Route::prefix('resident')->group(function () {
    // AUTH
    Route::get('/login', [ResidentAuthController::class, 'showLoginForm'])->name('resident.login');
    Route::post('/login', [ResidentAuthController::class, 'login'])->name('resident.login.submit');
    Route::get('/register', [ResidentAuthController::class, 'showRegisterForm'])->name('resident.register');
    Route::post('/register', [ResidentAuthController::class, 'register'])->name('resident.register.submit');

    // DASHBOARD
    Route::get('/dashboard', [ResidentDashboardController::class, 'dashboard'])->name('resident.dashboard');

    // DASHBOARD WITH VERIFICATION
    // Route::middleware('auth')->group(function() {
    //     Route::get('/dashboard', [ResidentDashboardController::class, 'dashboard'])->name('resident.dashboard');
    // });
});

// COLLECTOR ROUTES
Route::prefix('collector')->group(function () {
    // AUTH
    Route::get('/login', [CollectorAuthController::class, 'showLoginForm'])->name('collector.login');
    Route::post('/login', [CollectorAuthController::class, 'login'])->name('collector.login.submit');
    Route::get('/register', [CollectorAuthController::class, 'showRegisterForm'])->name('collector.register');
    Route::post('/register', [CollectorAuthController::class, 'register'])->name('collector.register.submit');

    // DASHBOARD
    Route::get('/dashboard', [CollectorDashboardController::class, 'dashboard'])->name('collector.dashboard');

    // DASHBOARD WITH VERIFICATION
    // Route::middleware('auth')->group(function() {
    //     Route::get('/dashboard', [CollectorDashboardController::class, 'dashboard'])->name('collector.dashboard');
    // });
});
