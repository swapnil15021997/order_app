<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

Route::get('/csrf-token', function () {
    return response()->json([
        'csrf_token' => csrf_token()
    ]);
});

// Forgot Password Page
// Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
//     ->name('password.request');

// Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
//     ->name('password.email');

// // Password Reset Form
// Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
//     ->name('password.reset');

// // Handle Password Reset Form Submission
// Route::post('/reset-password', [NewPasswordController::class, 'store'])
//     ->name('password.update');
require __DIR__.'/auth.php';
