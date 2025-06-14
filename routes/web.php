<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::with('galleries')->get();
    return view('welcome', compact('products'));
});
