<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', FrontController::class);
Route::get('/search', [FrontController::class, 'search']);
Route::get('/detail/{carStore:slug}', [FrontController::class, 'detail'])->name('store.detail');
Route::get('/booking/{carStore:slug}', [FrontController::class, 'booking'])->name('booking');
Route::post('/payment', [FrontController::class, 'payment'])->name('payment');
Route::get('/payment/form', [FrontController::class, 'paymentForm'])->name('payment.form');
Route::post('/payment/store', [FrontController::class, 'paymentStore'])->name('payment.store');
Route::get('/payment/success/{trx_id}', [FrontController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/booking', [FrontController::class, 'bookingCheck'])->name('booking.check');
Route::post('/booking/detail', [FrontController::class, 'bookingDetail'])->name('booking.detail');
