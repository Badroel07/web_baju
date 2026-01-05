<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/product/{product:slug}', \App\Livewire\Product\ProductDetail::class)->name('product.show');
Route::get('/cart', \App\Livewire\Cart::class)->name('cart');
Route::get('/checkout', \App\Livewire\Checkout::class)->name('checkout');
Route::post('/payment/notification', [\App\Http\Controllers\PaymentController::class, 'handleNotification'])->name('payment.notification');
