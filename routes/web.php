<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;

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

Route::get('/', [BookingController::class, 'bookings'])->name("get-events");
Route::post('/store-booking', [BookingController::class, 'storeBooking'])->name('store-booking');
Route::post('/update-booking', [BookingController::class, 'updateBooking'])->name('update-booking');
Route::post('/delete-booking', [BookingController::class, 'deleteBooking'])->name('delete-booking');
