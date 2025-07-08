<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// routes/api.php
Route::post('/bookings/pending', [BookingController::class, 'storePending'])->name('bookings.pending');
Route::get('/available-slots', [BookingController::class, 'availableSlots'])->name('available.slots');
Route::post('/ai/answer', [AiController::class, 'hfAnswer']);
