<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/product/{product}', [CatalogController::class, 'show'])->name('product.show');

Route::get('/order', [CartController::class, 'index'])->name('order');
Route::get('/cart/items', [CartController::class, 'items'])->name('cart.items');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product:id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product:id}', [CartController::class, 'destroy'])->name('cart.destroy');
