<?php

use App\Http\Controllers\Backend\Settings\ModuleController;
use App\Http\Controllers\Backend\Settings\PermissionController;
use App\Http\Controllers\Backend\Settings\RoleController;
use Illuminate\Support\Facades\Route;

/**
 * Role rputes
 */
Route::group([
  'prefix' => 'admin',
  'as' => 'admin.',
  'middleware' => 'auth',
], function () {
  Route::group([
    'prefix' => 'setting',
    'as' => 'setting.'
  ], function () {
    //Role routes
    Route::group([
      'prefix' => 'role',
      'as' => 'role.'
    ], function () {
      Route::get('create', [RoleController::class, 'create'])->name('create');
    });

    //Permission routes
    Route::group([
      'prefix' => 'permission',
      'as' => 'permission.'
    ], function () {
      Route::get('create', [PermissionController::class, 'create'])->name('create');
    });

    //Module routes
    Route::group([
      'prefix' => 'module',
      'as' => 'module.'
    ], function () {
      Route::get('/', [ModuleController::class, 'index'])->name('list');
      Route::get('create', [ModuleController::class, 'create'])->name('create');
      Route::post('store', [ModuleController::class, 'store'])->name('store');
      Route::get('edit/{id}', [ModuleController::class, 'edit'])->name('edit');
      Route::put('update/{id}', [ModuleController::class, 'update'])->name('update');
      Route::delete('destroy/{id}', [ModuleController::class, 'destroy'])->name('destroy');
    });
  });
});
