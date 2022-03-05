<?php

use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\DashboardContorller;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\RecreationController;
use App\Http\Controllers\Backend\ServiceController;
use Illuminate\Support\Facades\Route;


Route::group([
  'prefix' => 'admin',
  'as' => 'admin.',
  'middleware' => 'auth',
], function () {
  Route::get('/dashboard', [DashboardContorller::class, 'dashboard'])->name('dashboard');

  Route::group([
    'prefix' => 'about-us',
    'as' => 'about_us.'
  ], function () {
    Route::get('/', [AboutUsController::class, 'index'])->name('list');
    Route::get('create', [AboutUsController::class, 'create'])->name('create');
    Route::post('store', [AboutUsController::class, 'store'])->name('store');
    Route::get('edit/{id}', [AboutUsController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [AboutUsController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [AboutUsController::class, 'destroy'])->name('destroy');
  });

  Route::group([
    'prefix' => 'recreation',
    'as' => 'recreation.'
  ], function () {
    Route::get('/', [RecreationController::class, 'index'])->name('list');
    Route::get('create', [RecreationController::class, 'create'])->name('create');
    Route::post('store', [RecreationController::class, 'store'])->name('store');
    Route::get('edit/{id}', [RecreationController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [RecreationController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [RecreationController::class, 'destroy'])->name('destroy');
  });

  Route::group([
    'prefix' => 'service',
    'as' => 'service.'
  ], function () {
    Route::get('/', [ServiceController::class, 'index'])->name('list');
    Route::get('create', [ServiceController::class, 'create'])->name('create');
    Route::post('store', [ServiceController::class, 'store'])->name('store');
    Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [ServiceController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [ServiceController::class, 'destroy'])->name('destroy');
  });

  Route::group([
    'prefix' => 'event',
    'as' => 'event.'
  ], function () {
    Route::get('/', [EventController::class, 'index'])->name('list');
    Route::get('create', [EventController::class, 'create'])->name('create');
    Route::post('store', [EventController::class, 'store'])->name('store');
    Route::get('edit/{id}', [EventController::class, 'edit'])->name('edit');
    Route::put('update/{id}', [EventController::class, 'update'])->name('update');
    Route::delete('destroy/{id}', [EventController::class, 'destroy'])->name('destroy');
  });
});
