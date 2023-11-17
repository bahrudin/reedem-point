<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(static function () {

    // Authenticated
    Route::middleware(['auth:admin','verified.email'])->group(static function () {
        Route::get('/dashboard', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.dashboard');
    });

    //Profile
    Route::middleware(['auth:admin','password.confirm.admin','verified.email'])->group(function () {
        Route::get('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('/profile', [\App\Http\Controllers\Admin\ProfileController::class, 'destroy'])->name('admin.profile.destroy');
    });

    Route::middleware('guest:admin')->group(function () {
        Route::get('register', [\App\Http\Controllers\Admin\Auth\RegisteredUserController::class, 'create'])
            ->name('admin.register');
        Route::post('register', [\App\Http\Controllers\Admin\Auth\RegisteredUserController::class, 'store']);

        Route::get('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'create'])
            ->name('admin.login');
        Route::post('login', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'create'])
            ->name('admin.password.request');
        Route::post('forgot-password', [\App\Http\Controllers\Admin\Auth\PasswordResetLinkController::class, 'store'])
            ->name('admin.password.email');

        Route::get('reset-password/{token}', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'create'])
            ->name('admin.password.reset');
        Route::post('reset-password', [\App\Http\Controllers\Admin\Auth\NewPasswordController::class, 'store'])
            ->name('admin.password.store');
    });

    //Verify email
    Route::middleware('auth:admin')->group(function () {
        Route::get('verify-email', [\App\Http\Controllers\Admin\Auth\EmailVerificationPromptController::class, '__invoke'])->name('admin.verification.notice');
        Route::get('verify-email/{id}/{hash}', [\App\Http\Controllers\Admin\Auth\VerifyEmailController::class,'__invoke'])->middleware(['signed', 'throttle:6,1'])->name('admin.verification.verify');
        Route::post('email/verification-notification', [\App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('admin.verification.send');
    });

    // Authenticated routes
    Route::middleware(['auth:admin','verified.email'])->group(function () {
        Route::get('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'show'])->name('admin.password.confirm');
        Route::post('confirm-password', [\App\Http\Controllers\Admin\Auth\ConfirmablePasswordController::class, 'store']);
        Route::put('password', [\App\Http\Controllers\Admin\Auth\PasswordController::class, 'update'])->name('admin.password.update');
    });

    Route::middleware(['auth:admin'])->group(function () {
        Route::post('logout', [\App\Http\Controllers\Admin\Auth\AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
    });
});
