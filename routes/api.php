<?php

use App\Http\Controllers\AdminAnnouncementController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTrendingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/announcement', [AdminAnnouncementController::class, 'show']);

Route::get('/admin/totals', [AdminController::class, 'getTotals']);

Route::get('/trending/show', [AdminTrendingController::class, 'show']);

Route::post('/product/gcash-payment', [ProductController::class, 'processGcashPayment']);

Route::post('/cart/process-payment', [CartController::class, 'processPayment']);

