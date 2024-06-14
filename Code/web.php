<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\TopCryptoController;
use App\Http\Controllers\ChartsController;

Route::get('/', [CryptoController::class, 'index']);
Route::get('/top-10', [TopCryptoController::class, 'index']);
Route::get('/charts', [ChartsController::class, 'index']);
Route::get('/live-data', [ChartsController::class, 'getLiveData']);
Route::post('/favorite', [CryptoController::class, 'favorite']);
Route::get('/search', [CryptoController::class, 'search']);