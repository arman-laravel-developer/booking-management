<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HostelController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/sign-up', [CustomerController::class, 'index'])->name('sign.up');
Route::post('/sign-in', [CustomerController::class, 'login_check'])->name('sign.in');
Route::get('/sign-in', [CustomerController::class, 'logout'])->name('logout.customer');

Route::post('/booking-hostel', [BookingController::class, 'index'])->name('booking.hostel');
Route::get('/booking-check-in/{id}', [BookingController::class, 'checkIn'])->name('booking.checkId-approved');
Route::get('/booking-cancel/{id}', [BookingController::class, 'cancel'])->name('booking.cancel');
Route::get('/booking-check-out/{id}', [BookingController::class, 'checkOut'])->name('booking.checkOut-approved');
Route::get('/booking-delete/{id}', [BookingController::class, 'delete'])->name('booking.delete');

Route::get('/hostel-details/{id}', [HomeController::class, 'details'])->name('hostel.details');

Route::middleware([ 'auth:sanctum',  config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/booking', [DashboardController::class, 'booking'])->name('booking.manage');
    Route::get('/booking-show/{id}', [DashboardController::class, 'show'])->name('booking.show');

    Route::prefix('hostel')->group(function () {
        Route::get('/add', [HostelController::class, 'index'])->name('hostel.add');
        Route::post('/new', [HostelController::class, 'create'])->name('hostel.new');
        Route::get('/manage', [HostelController::class, 'manage'])->name('hostel.manage');
        Route::get('/edit/{id}',[HostelController::class, 'edit'])->name('hostel.edit');
        Route::post('/update/{id}', [HostelController::class, 'update'])->name('hostel.update');
        Route::post('/delete/{id}', [HostelController::class, 'delete'])->name('hostel.delete');
    });

});
