<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\BookingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// routes/api.php
Route::post('/bookings/pending', [BookingController::class, 'storePending']);
Route::get('/available-slots', [BookingController::class, 'availableSlots'])->name('available.slots');
Route::post('/ai/answer', [AiController::class, 'hfAnswer']);
