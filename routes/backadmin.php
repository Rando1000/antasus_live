<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Admin\ReferenzController;
use App\Http\Controllers\Admin\ServiceItemController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\MeetingController;
use App\Http\Controllers\Admin\EmailTrackingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\BookingController;


//----------------Rollen-Routes------------
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin/referenzen')
    ->name('admin.referenzen')
    ->group(function () {
        Route::get('/', [ReferenzController::class, 'index'])->name('index');
        Route::get('/create', [ReferenzController::class, 'create'])->name('create');
        Route::post('/', [ReferenzController::class, 'store'])->name('store');
        Route::get('/{referenz}/edit', [ReferenzController::class, 'edit'])->name('admin.referenzen.edit');
        Route::put('/{referenz}', [ReferenzController::class, 'update'])->name('update');
        Route::delete('/{referenz}', [ReferenzController::class, 'destroy'])->name('destroy');
        // Route::resource('referenzen/edit', ReferenzController::class)->except('edit');


    });


//-------------------------------------------

//--------------Admin_Dashboard--------------------------

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
});

//-------------------------------------------------------


//--------------Leistungen-Backend_Admin_Routes----------
Route::middleware(['auth', 'role:admin'])
->prefix('admin/services')->name('admin.services.')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('index');
    Route::get('/create', [ServiceController::class, 'create'])->name('create');
    Route::post('/', [ServiceController::class, 'store'])->name('store');
    Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
    Route::put('/{service}', [ServiceController::class, 'update'])->name('update');
    Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('destroy');
});
Route::middleware(['auth', 'role:admin'])
->prefix('admin/services/{service}/items')->name('admin.services.items.')->group(function () {
    Route::get('/', [ServiceItemController::class, 'index'])->name('index');
    Route::get('/create', [ServiceItemController::class, 'create'])->name('create');
    Route::post('/', [ServiceItemController::class, 'store'])->name('store');
    Route::get('/{item}/edit', [ServiceItemController::class, 'edit'])->name('edit');
    Route::put('/{item}', [ServiceItemController::class, 'update'])->name('update');
    Route::delete('/{item}', [ServiceItemController::class, 'destroy'])->name('destroy');
});

//------------------------------------------------------

//--------------------Buchungen-------------------------

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/bookings', [MeetingController::class, 'index'])->name('bookings.index');
    Route::put('/bookings/{booking}/status', [MeetingController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::delete('/bookings/{booking}', [MeetingController::class, 'destroy'])->name('bookings.destroy');

});


//--------------Buchungen_Ende--------------------------
