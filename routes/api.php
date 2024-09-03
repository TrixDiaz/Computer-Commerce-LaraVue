<?php

use App\Http\Controllers\AdminAnnouncementController;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/announcement/{title}', [AdminAnnouncementController::class, 'show']);