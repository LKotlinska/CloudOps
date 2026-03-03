<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/', fn() => redirect()->route('products.index'));

Route::post('/login', LoginController::class);

Route::post('/logout', LogoutController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('flavors', FlavorController::class);
    Route::resource('colors', ColorController::class);
});
