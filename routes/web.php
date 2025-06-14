<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'about']);