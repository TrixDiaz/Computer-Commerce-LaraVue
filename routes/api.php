<?php

use App\Http\Controllers\AdminAnnouncementController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/announcement', [AdminAnnouncementController::class, 'show']);