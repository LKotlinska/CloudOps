<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\ColorController;

// Redirect root to products
Route::get('/', function () {
    return redirect()->route('products.index');
});

Route::resource('products', ProductController::class);
Route::resource('brands',   BrandController::class);
Route::resource('flavors',  FlavorController::class);
Route::resource('colors',   ColorController::class);
