<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\EventController;

// ========================
// AUTH ROUTES
// ========================
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ========================
// PAGES (PUBLIC OR AUTHENTICATED)
// ========================
Route::middleware('auth')->group(function () {
    Route::get('/home', fn() => view('home'))->name('home');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/events', fn() => view('events'))->name('events');
    Route::get('/tickets', fn() => view('tickets'))->name('tickets');
});


// ========================
// ORDER ROUTES
// ========================
Route::middleware(['auth'])->group(function () {
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

// ========================
// SELL ROUTES
// ========================
Route::middleware(['auth'])->group(function () {
    Route::get('/sell', [SellController::class, 'index'])->name('sell.index');
    Route::post('/sell', [SellController::class, 'store'])->name('sell.store');
});

// ========================
// EVENT ROUTES
// ========================
Route::get('/events', [EventController::class, 'index'])->name('events.index');


