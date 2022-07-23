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
  'can' => 'auth',
], function () {
  Route::get('/dashboard', [DashboardContorller::class, 'dashboard'])->name('dashboard');

  Route::group([
    'prefix' => 'about-us',
    'as' => 'about_us.'
  ], function () {
    Route::get('/', [AboutUsController::class, 'index'])->name('list')->can('canViewList', App\Models\About::class);
    Route::get('create', [AboutUsController::class, 'create'])->name('create')->can('canCreate', App\Models\About::class);
    Route::post('store', [AboutUsController::class, 'store'])->name('store')->can('canCreate', App\Models\About::class);
    Route::get('edit/{id}', [AboutUsController::class, 'edit'])->name('edit')->can('canUpdate', App\Models\About::class);
    Route::put('update/{id}', [AboutUsController::class, 'update'])->name('update')->can('canUpdate', App\Models\About::class);
    Route::delete('destroy/{id}', [AboutUsController::class, 'destroy'])->name('destroy')->can('canDelete', App\Models\About::class);
  });

  Route::group([
    'prefix' => 'recreation',
    'as' => 'recreation.'
  ], function () {
    Route::get('/', [RecreationController::class, 'index'])->name('list')->can('canViewList', App\Models\Recreation::class);
    Route::get('create', [RecreationController::class, 'create'])->name('create')->can('canCreate', [App\Models\Recreation::class, "recreation", "create"]);
    Route::post('store', [RecreationController::class, 'store'])->name('store')->can('canCreate', [App\Models\Recreation::class, "recreation", "create"]);
    Route::get('edit/{id}', [RecreationController::class, 'edit'])->name('edit')->can('canUpdate', [App\Models\Recreation::class, "recreation", "update"]);
    Route::put('update/{id}', [RecreationController::class, 'update'])->name('update')->can('canUpdate', [App\Models\Recreation::class, "recreation", "update"]);
    Route::delete('destroy/{id}', [RecreationController::class, 'destroy'])->name('destroy')->can('canDelete', [App\Models\Recreation::class, "recreation", "delete"]);
  });

  Route::group([
    'prefix' => 'service',
    'as' => 'service.'
  ], function () {
    Route::get('/', [ServiceController::class, 'index'])->name('list')->can('canViewList', App\Models\Service::class);
    Route::get('create', [ServiceController::class, 'create'])->name('create')->can('canCreate', [App\Models\Service::class, "services", "create"]);
    Route::post('store', [ServiceController::class, 'store'])->name('store')->can('canCreate', [App\Models\Service::class, "services", "create"]);
    Route::get('edit/{id}', [ServiceController::class, 'edit'])->name('edit')->can('canUpdate', [App\Models\Service::class, "services", "update"]);
    Route::put('update/{id}', [ServiceController::class, 'update'])->name('update')->can('canUpdate', [App\Models\Service::class, "services", "update"]);
    Route::delete('destroy/{id}', [ServiceController::class, 'destroy'])->name('destroy')->can('canDelete', [App\Models\Service::class, "services", "delete"]);
  });

  Route::group([
    'prefix' => 'event',
    'as' => 'event.'
  ], function () {
    Route::get('/', [EventController::class, 'index'])->name('list')->can('canViewList', [App\Models\Event\Event::class, "event", "list-view"]);
    Route::get('create', [EventController::class, 'create'])->name('create')->can('canCreate', [App\Models\Event\Event::class, "event", "create"]);
    Route::post('store', [EventController::class, 'store'])->name('store')->can('canCreate', [App\Models\Event\Event::class, "event", "create"]);
    Route::post('store-file', [EventController::class, 'storeFile'])->name('store_file')->can('canCreate', [App\Models\Event\Event::class, "event", "create"]);
    Route::get('edit/{id}', [EventController::class, 'edit'])->name('edit')->can('canUpdate', [App\Models\Event\Event::class, "event", "update"]);
    Route::get('image/{id}', [EventController::class, 'getEventImages'])->name('image')->can('canUpdate', [App\Models\Event\Event::class, "event", "update"]);
    Route::put('update/{id}', [EventController::class, 'update'])->name('update')->can('canUpdate', [App\Models\Event\Event::class, "event", "update"]);
    Route::put('update-file', [EventController::class, 'storeFile'])->name('update_file')->can('canUpdate', [App\Models\Event\Event::class, "event", "update"]);
    Route::delete('destroy/{id}', [EventController::class, 'destroy'])->name('destroy')->can('canDelete', [App\Models\Event\Event::class, "event", "delete"]);
    Route::delete('image/destroy/{id}', [EventController::class, 'deleteImage'])->name('destroy_file')->can('canDelete', [App\Models\Event\Event::class, "event", "delete"]);
  });

  Route::group([
    'prefix' => 'bar',
    'as' => 'bar.'
  ], function () {
    Route::get('/', [BarController::class, 'index'])->name('list')->can('canViewList', [App\Models\Bar\Bar::class, "bar", "list-view"]);
    Route::get('create', [BarController::class, 'create'])->name('create')->can('canCreate', [App\Models\Bar\Bar::class, "bar", "create"]);
    Route::post('store', [BarController::class, 'store'])->name('store')->can('canCreate', [App\Models\Bar\Bar::class, "bar", "create"]);
    Route::post('store-file', [BarController::class, 'storeFile'])->name('store_file')->can('canCreate', [App\Models\Bar\Bar::class, "bar", "create"]);
    Route::get('edit/{id}', [BarController::class, 'edit'])->name('edit')->can('canUpdate', [App\Models\Bar\Bar::class, "bar", "update"]);
    Route::get('image/{id}', [BarController::class, 'getBarImages'])->name('image')->can('canUpdate', [App\Models\Bar\Bar::class, "bar", "create"]);
    Route::put('update/{id}', [BarController::class, 'update'])->name('update')->can('canUpdate', [App\Models\Bar\Bar::class, "bar", "update"]);
    Route::put('update-file', [BarController::class, 'storeFile'])->name('update_file')->can('canUpdate', [App\Models\Bar\Bar::class, "bar", "update"]);
    Route::delete('destroy/{id}', [BarController::class, 'destroy'])->name('destroy')->can('canDelete', [App\Models\Bar\Bar::class, "bar", "delete"]);
    Route::delete('image/destroy/{id}', [BarController::class, 'deleteImage'])->name('destroy_file')->can('canDelete', [App\Models\Bar\Bar::class, "bar", "delete"]);
  });

  Route::group([
    'prefix' => 'gallery',
    'as' => 'gallery.'
  ], function () {
    Route::get('/', [GalleryController::class, 'index'])->name('list')->can('canViewList', [App\Models\Gallery\Gallery::class, "gallery", "list-view"]);
    Route::get('create', [GalleryController::class, 'create'])->name('create')->can('canCreate', [App\Models\Gallery\Gallery::class, "gallery", "create"]);
    Route::post('store', [GalleryController::class, 'store'])->name('store')->can('canCreate', [App\Models\Gallery\Gallery::class, "gallery", "create"]);
    Route::post('store-file', [GalleryController::class, 'storeFile'])->name('store_file')->can('canCreate', [App\Models\Gallery\Gallery::class, "gallery", "create"]);
    Route::get('edit/{id}', [GalleryController::class, 'edit'])->name('edit')->can('canUpdate', [App\Models\Gallery\Gallery::class, "gallery", "update"]);
    Route::get('image/{id}', [GalleryController::class, 'getGalleryImages'])->name('image')->can('canUpdate', [App\Models\Gallery\Gallery::class, "gallery", "create"]);
    Route::put('update/{id}', [GalleryController::class, 'update'])->name('update')->can('canUpdate', [App\Models\Gallery\Gallery::class, "gallery", "update"]);
    Route::put('update-file', [GalleryController::class, 'storeFile'])->name('update_file')->can('canUpdate', [App\Models\Gallery\Gallery::class, "gallery", "update"]);
    Route::delete('destroy/{id}', [GalleryController::class, 'destroy'])->name('destroy')->can('canDelete', [App\Models\Gallery\Gallery::class, "gallery", "delete"]);
    Route::delete('image/destroy/{id}', [GalleryController::class, 'deleteImage'])->name('destroy_file')->can('canDelete', [App\Models\Gallery\Gallery::class, "gallery", "delete"]);
  });



  Route::group([
    'prefix' => 'roomtype',
    'as' => 'roomtype.'
  ], function () {
    Route::get('/', [RoomTypeController::class, 'index'])->name('list')->can('canViewList', [App\Models\Room\RoomType::class, "room-type", "list-view"]);
    Route::get('create', [RoomTypeController::class, 'create'])->name('create')->can('canCreate', [App\Models\Room\RoomType::class, "room-type", "create"]);
    Route::post('store', [RoomTypeController::class, 'store'])->name('store')->can('canCreate', [App\Models\Room\RoomType::class, "room-type", "create"]);
    Route::post('store-file', [RoomTypeController::class, 'storeFile'])->name('store_file')->can('canCreate', [App\Models\Room\RoomType::class, "room-type", "create"]);
    Route::get('edit/{id}', [RoomTypeController::class, 'edit'])->name('edit')->can('canUpdate', [App\Models\Room\RoomType::class, "room-type", "update"]);
    Route::get('image/{id}', [RoomTypeController::class, 'getRoomImages'])->name('image')->can('canUpdate', [App\Models\Room\RoomType::class, "room-type", "create"]);
    Route::put('update/{id}', [RoomTypeController::class, 'update'])->name('update')->can('canUpdate', [App\Models\Room\RoomType::class, "room-type", "update"]);
    Route::put('update-file', [RoomTypeController::class, 'storeFile'])->name('update_file')->can('canUpdate', [App\Models\Room\RoomType::class, "room-type", "update"]);
    Route::delete('destroy/{id}', [RoomTypeController::class, 'destroy'])->name('destroy')->can('canDelete', [App\Models\Room\RoomType::class, "room-type", "delete"]);
    Route::delete('image/destroy/{id}', [RoomTypeController::class, 'deleteImage'])->name('destroy_file')->can('canDestroy', [App\Models\Room\RoomType::class, "room-type", "delete"]);

    Route::group([
      'prefix' => 'feature',
      'as' => 'feature.'
    ], function () {
      Route::get('/', [RoomFeatureController::class, 'index'])->name('list')->can('canViewList', [App\Models\Room\RoomFeature::class, "room-feature", "list-view"]);
      Route::get('create', [RoomFeatureController::class, 'create'])->name('create')->can('canCreate', [App\Models\Room\RoomFeature::class, "room-feature", "create"]);
      Route::post('store', [RoomFeatureController::class, 'store'])->name('store')->can('canCreate', [App\Models\Room\RoomFeature::class, "room-feature", "create"]);
      Route::get('edit/{id}', [RoomFeatureController::class, 'edit'])->name('edit')->can('canUpdate', [App\Models\Room\RoomFeature::class, "room-feature", "update"]);
      Route::put('update/{id}', [RoomFeatureController::class, 'update'])->name('update')->can('canUpdate', [App\Models\Room\RoomFeature::class, "room-feature", "update"]);
      Route::delete('destroy/{id}', [RoomFeatureController::class, 'destroy'])->name('destroy')->can('canDelete', [App\Models\Room\RoomFeature::class, "room-feature", "delete"]);
    });
  });


  Route::group([
    'prefix' => 'booking',
    'as' => 'booking.'
  ], function () {
    Route::get('/', [BookingController::class, 'index'])->name('list')->can('canViewList', [App\Models\Booking::class, "booking", "list-view"]);
    Route::get('/change/status/{id}', [BookingController::class, 'changeBookingStatus'])->name('status')->can('canUpdate', [App\Models\Booking::class, "booking", "delete"]);
  });
});
