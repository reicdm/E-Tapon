<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChooseUserController;
use App\Http\Controllers\CollectorPassController;
use App\Http\Controllers\ResidentPassController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('chooseuser')->group(function () {
    Route::get('/', [ChooseUserController::class, 'showChooseUser'])->name('chooseuser');
    Route::post('/resident', [ChooseUserController::class, 'store'])->name('chooseuser.resident.store');
});

Route::prefix('resident')->group(function () {
    Route::get('/forgotpassword', [ResidentPassController::class, 'showForgotPass'])->name('resident.forgotpass');
});

Route::prefix('collector')->group(function () {
    Route::get('/forgotpassword', [CollectorPassController::class, 'showForgotPass'])->name('collector.forgotpass');
    //Route::post('/forgotpassword', [CollectorPassController::class, 'save'])->name('collector.forgotpass.save')
});
