<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/catalog', [ProductController::class, 'indexProducts'])->name('catalog');

Route::get('/order', function () {
    return view('order');
})->name('order');