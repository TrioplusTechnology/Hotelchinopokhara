<?php

use App\Http\Controllers\Frontend\AboutUsController;
use App\Http\Controllers\Frontend\BarController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\EventController;
use App\Http\Controllers\Frontend\GalleryController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\RecreationController;
use App\Http\Controllers\Frontend\RoomController;
use App\Http\Controllers\Frontend\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/about-us', [AboutUsController::class, 'index']);
Route::get('/room', [RoomController::class, 'index']);
Route::get('/bar', [BarController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/recreation', [RecreationController::class, 'index']);
Route::get('/event', [EventController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/gallery', [GalleryController::class, 'index']);
Route::get('/gallery/album/{id}', [GalleryController::class, 'getAlbums']);

Route::get('/book', [BookingController::class, 'index']);
Route::post('/book', [BookingController::class, 'book']);
// /**
//  * Auth routes
//  */
// require __DIR__ . '/backend/auth.php';
// /**
//  * Admin routes
//  */
// require __DIR__ . '/backend/admin.php';
// require __DIR__ . '/backend/setting.php';
