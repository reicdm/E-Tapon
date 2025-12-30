<?php

use App\Http\Controllers\CollectorAuthController;
use App\Http\Controllers\CollectorDashboardController;
use App\Http\Controllers\CollectorScheduleController;
use App\Http\Controllers\CollectorRequestController;
use App\Http\Controllers\CollectorReqDetailsController;
use App\Http\Controllers\CollectorAcceptedReqController;
use App\Http\Controllers\CollectorProfileController;
use App\Http\Controllers\CollectorProfileEditController;
use App\Http\Controllers\CollectorReqReqDetailsController;
use App\Http\Controllers\CollectorSuccessController;

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
    // LOGIN
    Route::get('/login', [CollectorAuthController::class, 'showLoginForm'])->name('collector.login');
    Route::post('/login', [CollectorAuthController::class, 'login'])->name('login');
    // FORGOT PASSWORD
    Route::get('/forgot', [CollectorAuthController::class, 'showForgotForm'])->name('collector.forgot');
    Route::get('/forgot/confirm', [CollectorAuthController::class, 'showForgotConfirm'])->name('collector.forgot.showConfirm');
    Route::post('/forgot/confirm', [CollectorAuthController::class, 'confirmForgot'])->name('collector.forgot.confirm');
    // LOGOUT
    Route::post('/logout', [CollectorAuthController::class, 'logout'])->name('collector.logout');

    // DASHBOARD WITH VERIFICATION
    Route::middleware('auth:collector')->group(function () {
        Route::get('/dashboard', [CollectorDashboardController::class, 'showOverview'])->name('collector.dashboard');
        Route::get('/schedule', [CollectorScheduleController::class, 'showSchedule'])->name('collector.schedule');
        Route::get('/schedule/confirm', [CollectorScheduleController::class, 'showUpdateConfirm'])->name('collector.schedule.confirm');
        Route::post('/schedule/update', [CollectorScheduleController::class, 'updateStatus'])->name('collector.schedule.updateStatus');

        // Profile routes
        Route::get('/profile', [CollectorProfileController::class, 'showProfile'])->name('collector.profile');
        Route::get('/profile/edit', [CollectorProfileEditController::class, 'showProfileEdit'])->name('collector.profileedit');
        Route::get('/profile/confirm', [CollectorProfileEditController::class, 'showUpdateConfirm'])->name('collector.profile.confirm');
        Route::post('/profile/confirm-update', [CollectorProfileEditController::class, 'confirmUpdate'])->name('collector.profile.confirmUpdate');
        Route::get('/profile/success', [CollectorSuccessController::class, 'showSuccess'])->name('collector.profile.success');

        // request routes
        Route::prefix('request')->group(function () {
            Route::get('/', [CollectorRequestController::class, 'showRequest'])->name('collector.request');
            Route::get('/acceptedrequest/{requestId}', [CollectorAcceptedReqController::class, 'showAcceptedRequest'])->name('collector.acceptedrequest');
            Route::get('/acceptedrequest/{requestId}/confirm', [CollectorAcceptedReqController::class, 'showUpdateConfirm'])->name('collector.acceptedrequest.confirm');
            Route::post('/acceptedrequest/{requestId}/updateStatus', [CollectorAcceptedReqController::class, 'updateStatus'])->name('collector.acceptedrequest.updateStatus');
        });

        // request details
        Route::prefix('requestdetails')->group(function () {
            Route::get('/{requestId}', [CollectorReqDetailsController::class, 'showRequestDetails'])->name('collector.reqdetails.showRequestDetails');
            Route::get('/{requestId}/confirm', [CollectorReqDetailsController::class, 'showAcceptConfirm'])->name('collector.reqdetails.confirm');
            Route::post('/{requestId}/accept', [CollectorReqDetailsController::class, 'accept'])->name('collector.reqdetails.accept');
            Route::post('/{requestId}/decline', [CollectorReqDetailsController::class, 'decline'])->name('collector.reqdetails.decline');
        });

        // request request details
        Route::prefix('reqreqdetails')->group(function () {
            Route::get('/{requestId}', [CollectorReqReqDetailsController::class, 'showRequestDetails'])->name('collector.reqreqdetails.showRequestDetails');
            Route::post('/{requestId}/accept', [CollectorReqReqDetailsController::class, 'accept'])->name('collector.reqreqdetails.accept');
            Route::post('/{requestId}/decline', [CollectorReqReqDetailsController::class, 'decline'])->name('collector.reqreqdetails.decline');
        });

        // Success routes
        Route::get('/success/{requestId}', [CollectorSuccessController::class, 'showSuccess'])->name('collector.success');
        Route::post('/success/confirm', [CollectorSuccessController::class, 'confirmSuccess'])->name('collector.success.confirm');
    });
});
