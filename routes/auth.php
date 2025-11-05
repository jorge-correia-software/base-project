<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// All authentication routes are under /admin prefix
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest routes (login, signup, password reset)
    Route::middleware('guest')->group(function () {
        // Sign up
        Route::get('/signup', function () {
            return view('auth.signup');
        })->name('signup');

        Route::post('/signup', [RegisteredUserController::class, 'store'])
            ->name('signup.post');

        // Sign in
        Route::get('/signin', function () {
            return view('auth.signin');
        })->name('signin');

        Route::post('/signin', [AuthenticatedSessionController::class, 'store'])
            ->name('signin.post');

        // Forgot password
        Route::get('/forgot-password', function () {
            return view('auth.forgot-password');
        })->name('password.request');

        Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::post('/reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

    // Authenticated routes
    Route::middleware('auth')->group(function () {
        // Email verification
        Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        // Sign out
        Route::post('/signout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('signout');
    });
});
