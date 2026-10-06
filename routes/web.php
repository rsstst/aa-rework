<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatalogController;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog');

Route::get('/order', function () {
    return view('order');
})->name('order');