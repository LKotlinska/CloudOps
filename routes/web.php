<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', fn() => view('index'))->name('login');

Route::post('/login', LoginController::class);

Route::post('/logout', LogoutController::class)->middleware('auth');

Route::resource('/products', ProductController::class)->middleware('auth');

Route::resource('/categories', CategoryController::class)->middleware('auth');
