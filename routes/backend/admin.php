<?php

use App\Http\Controllers\Backend\AboutUsController;
use App\Http\Controllers\Backend\BarController;
use App\Http\Controllers\Backend\BookingController;
use App\Http\Controllers\Backend\DashboardContorller;
use App\Http\Controllers\Backend\EventController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\RecreationController;
use App\Http\Controllers\Backend\Room\RoomFeatureController;
use App\Http\Controllers\Backend\Room\RoomTypeController;
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
    Route::post('store-file', [EventController::class, 'storeFile'])->name('store_file');
    Route::get('edit/{id}', [EventController::class, 'edit'])->name('edit');
    Route::get('image/{id}', [EventController::class, 'getEventImages'])->name('image');
    Route::put('update/{id}', [EventController::class, 'update'])->name('update');
    Route::put('update-file', [EventController::class, 'storeFile'])->name('update_file');
    Route::delete('destroy/{id}', [EventController::class, 'destroy'])->name('destroy');
    Route::delete('image/destroy/{id}', [EventController::class, 'deleteImage'])->name('destroy_file');
  });

  Route::group([
    'prefix' => 'bar',
    'as' => 'bar.'
  ], function () {
    Route::get('/', [BarController::class, 'index'])->name('list');
    Route::get('create', [BarController::class, 'create'])->name('create');
    Route::post('store', [BarController::class, 'store'])->name('store');
    Route::post('store-file', [BarController::class, 'storeFile'])->name('store_file');
    Route::get('edit/{id}', [BarController::class, 'edit'])->name('edit');
    Route::get('image/{id}', [BarController::class, 'getBarImages'])->name('image');
    Route::put('update/{id}', [BarController::class, 'update'])->name('update');
    Route::put('update-file', [BarController::class, 'storeFile'])->name('update_file');
    Route::delete('destroy/{id}', [BarController::class, 'destroy'])->name('destroy');
    Route::delete('image/destroy/{id}', [BarController::class, 'deleteImage'])->name('destroy_file');
  });

  Route::group([
    'prefix' => 'gallery',
    'as' => 'gallery.'
  ], function () {
    Route::get('/', [GalleryController::class, 'index'])->name('list');
    Route::get('create', [GalleryController::class, 'create'])->name('create');
    Route::post('store', [GalleryController::class, 'store'])->name('store');
    Route::post('store-file', [GalleryController::class, 'storeFile'])->name('store_file');
    Route::get('edit/{id}', [GalleryController::class, 'edit'])->name('edit');
    Route::get('image/{id}', [GalleryController::class, 'getGalleryImages'])->name('image');
    Route::put('update/{id}', [GalleryController::class, 'update'])->name('update');
    Route::put('update-file', [GalleryController::class, 'storeFile'])->name('update_file');
    Route::delete('destroy/{id}', [GalleryController::class, 'destroy'])->name('destroy');
    Route::delete('image/destroy/{id}', [GalleryController::class, 'deleteImage'])->name('destroy_file');
  });

  Route::group([
    'prefix' => 'roomtype',
    'as' => 'roomtype.'
  ], function () {
    Route::get('/', [RoomTypeController::class, 'index'])->name('list');
    Route::get('create', [RoomTypeController::class, 'create'])->name('create');
    Route::post('store', [RoomTypeController::class, 'store'])->name('store');
    Route::post('store-file', [RoomTypeController::class, 'storeFile'])->name('store_file');
    Route::get('edit/{id}', [RoomTypeController::class, 'edit'])->name('edit');
    Route::get('image/{id}', [RoomTypeController::class, 'getRoomImages'])->name('image');
    Route::put('update/{id}', [RoomTypeController::class, 'update'])->name('update');
    Route::put('update-file', [RoomTypeController::class, 'storeFile'])->name('update_file');
    Route::delete('destroy/{id}', [RoomTypeController::class, 'destroy'])->name('destroy');
    Route::delete('image/destroy/{id}', [RoomTypeController::class, 'deleteImage'])->name('destroy_file');

    Route::group([
      'prefix' => 'feature',
      'as' => 'feature.'
    ], function () {
      Route::get('/', [RoomFeatureController::class, 'index'])->name('list');
      Route::get('create', [RoomFeatureController::class, 'create'])->name('create');
      Route::post('store', [RoomFeatureController::class, 'store'])->name('store');
      Route::get('edit/{id}', [RoomFeatureController::class, 'edit'])->name('edit');
      Route::put('update/{id}', [RoomFeatureController::class, 'update'])->name('update');
      Route::delete('destroy/{id}', [RoomFeatureController::class, 'destroy'])->name('destroy');
    });
  });

  Route::group([
    'prefix' => 'booking',
    'as' => 'booking.'
  ], function () {
    Route::get('/', [BookingController::class, 'index'])->name('list');
    Route::get('/change/status/{id}', [BookingController::class, 'changeBookingStatus'])->name('status');
  });
});
