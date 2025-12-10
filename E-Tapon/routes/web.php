<?php

use App\Http\Controllers\CollectorAuthController;
use App\Http\Controllers\CollectorDashboardController;
use App\Http\Controllers\CollectorScheduleController;
use App\Http\Controllers\CollectorRequestController;
use App\Http\Controllers\CollectorReqDetailsController;

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
    // LOGIN
    Route::get('/login', [ResidentAuthController::class, 'showLoginForm'])->name('resident.login');
    Route::post('/login', [ResidentAuthController::class, 'login'])->name('resident.login.submit');
    // REGISTER
    Route::get('/register', [ResidentAuthController::class, 'showRegisterForm'])->name('resident.register');
    Route::post('/register', [ResidentAuthController::class, 'register'])->name('resident.register.submit');
    // FORGOT
    Route::get('/forgot', [ResidentAuthController::class, 'showForgotForm'])->name('resident.forgot');
    Route::post('/forgot', [ResidentAuthController::class, 'forgot'])->name('resident.forgot.submit');
    Route::get('/forgot-success', function () {
        return view('auth.resident.forgotsuccess');
    })->name('resident.success');

    // LOGOUT
    Route::post('/logout', [ResidentAuthController::class, 'logout'])->name('resident.logout');

    // DASHBOARD WITH VERIFICATION
    // Route::middleware('auth')->group(function () {
    //     Route::get('/dashboard', [ResidentDashboardController::class, 'dashboard'])->name('resident.dashboard');
    // });

    Route::get('/dashboard', [ResidentDashboardController::class, 'dashboard'])->name('resident.dashboard');
    Route::get('/schedule', [ResidentDashboardController::class, 'schedule'])->name('resident.schedule');
    Route::get('/request', [ResidentDashboardController::class, 'request'])->name('resident.request');
    Route::get('/request/create', [ResidentDashboardController::class, 'showRequestForm'])->name('resident.request.create');
    Route::post('/request/create', [ResidentDashboardController::class, 'create'])->name('resident.request.submit');
    Route::get('/profile', [ResidentDashboardController::class, 'profile'])->name('resident.profile');
});

// COLLECTOR ROUTES
Route::prefix('collector')->group(function () {
    // AUTH
    Route::get('/greet', function () {
        return view('auth.collector.greet');
    });
    // LOGIN
    Route::get('/login', [CollectorAuthController::class, 'showLoginForm'])->name('collector.login');
    Route::post('/login', [CollectorAuthController::class, 'login'])->name('collector.login.submit');
    // FORGOT
    Route::get('/forgot', [CollectorAuthController::class, 'showForgotForm'])->name('collector.forgot');
    Route::post('/forgot', [CollectorAuthController::class, 'forgot'])->name('collector.forgot.submit');
    Route::get('/forgot-success', function () {
        return view('auth.collector.forgotsuccess');
    })->name('collector.success');
    // LOGOUT
    Route::post('/logout', [CollectorAuthController::class, 'logout'])->name('collector.logout');

    // DASHBOARD WITH VERIFICATION
    /*Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [CollectorDashboardController::class, 'dashboard'])->name('collector.dashboard');
    });*/

    Route::get('/dashboard', [CollectorDashboardController::class, 'showOverview'])->name('collector.dashboard');
    Route::get('/requestdetails', [CollectorReqDetailsController::class, 'showRequestDetails'])->name('collector.requestdetails');
    Route::get('/schedule', [CollectorScheduleController::class, 'showSchedule'])->name('collector.schedule');
    Route::get('/request', [CollectorRequestController::class, 'showRequest'])->name('collector.request');
});
