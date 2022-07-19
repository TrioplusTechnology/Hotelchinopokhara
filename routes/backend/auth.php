<?php

use App\Http\Controllers\Backend\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Backend\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Backend\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Backend\Auth\NewPasswordController;
use App\Http\Controllers\Backend\Auth\VerifyEmailController;
use App\Http\Controllers\Backend\Auth\PasswordResetLinkController;
use App\Http\Controllers\Backend\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Auth\RegisteredUserController;
use App\Http\Controllers\Backend\UserManagement\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
  'prefix' => 'admin',
  'as' => 'admin.'
], function () {
  Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

  Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest')
    ->name('login');

  Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

  Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

  Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

  Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

  Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth')
    ->name('verification.notice');

  Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

  Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

  Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth')
    ->name('password.confirm');

  Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth');

  Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

  Route::get('/dashboard', [DashboardContorller::class, 'dashboard'])->middleware('auth')->name('dashboard');

  Route::group([
    'prefix' => 'user-management',
    'as' => 'user-management.'
  ], function () {
    Route::group([
      'prefix' => 'user',
      'as' => 'user.',
      'middleware' => 'auth',
    ], function () {
      Route::get('/', [UserController::class, 'index'])->name('list');
      Route::get('/register', [UserController::class, 'create'])
        ->name('register');
      Route::post('/register', [UserController::class, 'store'])->name('store');
      Route::get('/register/edit/{id}', [UserController::class, 'edit'])->name('edit');
      Route::put('/register/update/{id}', [UserController::class, 'update'])->name('update');
      Route::delete('/register/delete/{id}', [UserController::class, 'delete'])->name('delete');
    });
  });
});
