<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FlavorController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', fn() => view('index'))->name('login');

Route::post('/login', LoginController::class);

Route::post('/logout', LogoutController::class)->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/start', [HomeController::class, 'startPage'])->name('start-page');

    Route::resource('products', ProductController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('flavors', FlavorController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('categories', CategoryController::class);
});
