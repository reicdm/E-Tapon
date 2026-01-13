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
    return view('select_role');
});

// RESIDENT ROUTES
Route::prefix('resident')->group(function () {
    // AUTH
    Route::get('greet', function () {
        return view('auth.resident.greet');
    });
    // REGISTER
    Route::get('/register', [ResidentAuthController::class, 'showRegisterForm'])->name('resident.register');
    Route::post('/register', [ResidentAuthController::class, 'register'])->name('resident.register.submit');
    // LOGIN
    Route::get('/login', [ResidentAuthController::class, 'showLoginForm'])->name('resident.login');
    Route::post('/login', [ResidentAuthController::class, 'login'])->name('resident.login.submit');
    // FORGOT
    Route::get('/forgot', [ResidentAuthController::class, 'showForgotForm'])->name('resident.forgot');
    Route::post('/forgot', [ResidentAuthController::class, 'forgot'])->name('resident.forgot.submit');
    Route::get('/forgot-success', function () {
        return view('auth.resident.forgotsuccess');
    })->name('resident.success');

    // LOGOUT
    Route::post('/logout', [ResidentAuthController::class, 'logout'])->name('resident.logout');

    // PROTECTED routes (require login)
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [ResidentDashboardController::class, 'dashboard'])->name('resident.dashboard');
        Route::get('/schedule', [ResidentDashboardController::class, 'schedule'])->name('resident.schedule');
        Route::get('/request', [ResidentDashboardController::class, 'request'])->name('resident.request');
        Route::get('/request/create', [ResidentDashboardController::class, 'showRequestForm'])->name('resident.request.create');
        Route::post('/request/create', [ResidentDashboardController::class, 'create'])->name('resident.request.submit');
        Route::put('/resident/request/{request_id}/cancel', [ResidentDashboardController::class, 'cancelRequest'])
            ->name('resident.request.cancel');

        // PROFILE ROUTES
        Route::get('/profile', [ResidentDashboardController::class, 'profile'])->name('resident.profile');
        Route::get('/profile/edit', [ResidentDashboardController::class, 'editProfile'])->name('resident.profile.edit');
        Route::post('/profile/update', [ResidentDashboardController::class, 'updateProfile'])->name('resident.profile.update');

        Route::get('/profile/change-password', [ResidentDashboardController::class, 'showChangePasswordForm'])
            ->name('resident.profile.change_password');
        Route::post('/profile/change-password', [ResidentDashboardController::class, 'updatePassword'])
            ->name('resident.profile.update_password');

        Route::get('/profile/change-address', [ResidentDashboardController::class, 'showChangeAddressForm'])
            ->name('resident.profile.change_address');
        Route::post('/profile/change-address', [ResidentDashboardController::class, 'updateAddress'])
            ->name('resident.profile.update_address');
        Route::delete('/profile/delete-account', [ResidentDashboardController::class, 'deleteAccount'])
            ->name('resident.account.delete');
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
    Route::post('/logout', [CollectorAuthController::class, 'logout'])->name('collector.logout');
    // FORGOT PASSWORD
    Route::get('/forgot', [CollectorAuthController::class, 'showForgotForm'])->name('collector.forgot');
    Route::get('/forgot/confirm', [CollectorAuthController::class, 'showForgotConfirm'])->name('collector.forgot.showConfirm');
    Route::post('/forgot/confirm', [CollectorAuthController::class, 'confirmForgot'])->name('collector.forgot.confirm');
    // LOGOUT
    Route::post('/logout', [CollectorAuthController::class, 'logout'])->name('collector.logout');

    // DASHBOARD WITH VERIFICATION
    Route::middleware('auth:collector')->group(function () {
        // Dashboard
        Route::get('/dashboard', [CollectorDashboardController::class, 'showOverview'])->name('collector.dashboard');
        Route::post('/dashboard/{requestId}/accept', [CollectorDashboardController::class, 'accept'])->name('collector.dashboard.accept');

        // Schedule
        Route::get('/schedule', [CollectorScheduleController::class, 'showSchedule'])->name('collector.schedule');
        Route::post('/collector/schedule/update', [CollectorScheduleController::class, 'updateStatus'])->name('collector.schedule.update');

        // Profile routes
        Route::get('/profile', [CollectorProfileController::class, 'showProfile'])->name('collector.profile');
        Route::get('/profile/edit', [CollectorProfileEditController::class, 'showProfileEdit'])->name('collector.profileedit');
        Route::get('/profile/confirm', [CollectorProfileEditController::class, 'showUpdateConfirm'])->name('collector.profile.confirm');
        Route::post('/profile/confirm-update', [CollectorProfileEditController::class, 'confirmUpdate'])->name('collector.profile.confirmUpdate');
        Route::post('/profile/update', [CollectorProfileEditController::class, 'update'])->name('collector.profile.update');

        // Request routes
        Route::prefix('request')->group(function () {
            Route::get('/', [CollectorRequestController::class, 'showRequest'])->name('collector.request');
            Route::post('/{requestId}/accept', [CollectorRequestController::class, 'accept'])->name('collector.request.accept');
            // Route::get('/acceptedrequest/{requestId}', [CollectorAcceptedReqController::class, 'showAcceptedRequest'])->name('collector.acceptedrequest');
            Route::get('/{requestId}/success', [CollectorDashboardController::class, 'showSuccess'])->name('collector.request.success');
            Route::post('/{requestId}/update', [CollectorRequestController::class, 'updateStatus'])->name('collector.request.update');
        });
    });
});
