<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');

// Route::middleware('web')->group(function () {
//     Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//         ->name('password.email');
// });
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
// ->middleware('guest')
->name('password.email');


Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

// Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
//     ->middleware('guest')
//     ->name('password.request');

    
// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])

//     // ->middleware('guest')
//     ->name('password.email');

Route::get('/password-reset/{token}', [NewPasswordController::class, 'create'])
    // ->middleware('guest')
    ->name('password.store');


Route::post('/reset-password', [NewPasswordController::class, 'store'])
    // ->middleware('guest')
    ->name('password.store');

Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
