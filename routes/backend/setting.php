<?php

use App\Http\Controllers\Backend\Settings\ModuleController;
use App\Http\Controllers\Backend\Settings\PermissionController;
use App\Http\Controllers\Backend\Settings\RoleController;
use App\Http\Controllers\Backend\Settings\RoleModulePermissionMappingController;
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
      Route::get('/', [RoleController::class, 'index'])->name('list');
      Route::get('create', [RoleController::class, 'create'])->name('create');
      Route::post('store', [RoleController::class, 'store'])->name('store');
      Route::get('edit/{id}', [RoleController::class, 'edit'])->name('edit');
      Route::put('update/{id}', [RoleController::class, 'update'])->name('update');
      Route::delete('destroy/{id}', [RoleController::class, 'destroy'])->name('destroy');
    });

    //Permission routes
    Route::group([
      'prefix' => 'permission',
      'as' => 'permission.'
    ], function () {
      Route::get('/', [PermissionController::class, 'index'])->name('list');
      Route::get('create', [PermissionController::class, 'create'])->name('create');
      Route::post('store', [PermissionController::class, 'store'])->name('store');
      Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('edit');
      Route::put('update/{id}', [PermissionController::class, 'update'])->name('update');
      Route::delete('destroy/{id}', [PermissionController::class, 'destroy'])->name('destroy');
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

    //Module routes
    Route::group([
      'prefix' => 'mapping',
      'as' => 'mapping.'
    ], function () {
      Route::get('/', [RoleModulePermissionMappingController::class, 'index'])->name('list');
      Route::get('create', [RoleModulePermissionMappingController::class, 'create'])->name('create');
      Route::post('store', [RoleModulePermissionMappingController::class, 'store'])->name('store');
      Route::get('edit/{roleId}/{moduleId}', [RoleModulePermissionMappingController::class, 'edit'])->name('edit');
      Route::put('update/{roleId}/{moduleId}', [RoleModulePermissionMappingController::class, 'update'])->name('update');
      Route::delete('destroy/{roleId}/{moduleId}', [RoleModulePermissionMappingController::class, 'destroy'])->name('destroy');
      Route::post('get-permission-by-module', [RoleModulePermissionMappingController::class, 'getPermissionByModule'])->name('get-permission-by-module');
    });
  });
});
