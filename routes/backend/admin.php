<?php

use App\Http\Controllers\Backend\DashboardContorller;
use Illuminate\Support\Facades\Route;


Route::group([
  'prefix' => 'admin',
  'as' => 'admin.',
  'middleware' => 'auth',
], function () {
  Route::get('/dashboard', [DashboardContorller::class, 'dashboard'])->name('dashboard');
});
