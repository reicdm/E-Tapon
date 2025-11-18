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
    Route::get('/login', [ResidentAuthController::class, 'showLoginForm'])->name('resident.login');
    Route::post('/login', [ResidentAuthController::class, 'login'])->name('resident.login.submit');
    Route::get('/dashboard', [ResidentDashboardController::class, 'dashboard'])->name('resident.dashboard');
});

// COLLECTOR ROUTES
Route::prefix('collector')->group(function () {
    Route::get('/login', [CollectorAuthController::class, 'showLoginForm'])->name('collector.login');
    Route::post('/login', [CollectorAuthController::class, 'login'])->name('collector.login.submit');
    Route::get('/dashboard', [CollectorDashboardController::class, 'dashboard'])->name('collector.dashboard');
});
