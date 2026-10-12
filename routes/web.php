<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/product/{product}', [CatalogController::class, 'show'])->name('product.show');

Route::get('/order', function () {
    return view('order');
})->name('order');
