<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Models\Product;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);
Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/{id}', [OrderController::class, 'create'])->name('order.create');