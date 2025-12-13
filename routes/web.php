<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\PublicKostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicKostController::class, 'index'])->name('home');
Route::get('/kost', [PublicKostController::class, 'index'])->name('kost.search');
Route::get('/kost/{kost}', [PublicKostController::class, 'show'])->name('kost.show');

/*
|--------------------------------------------------------------------------
| Review & Booking (Seeker)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::post('/kost/{kost}/review',
        [ReviewController::class, 'store'])
        ->name('review.store');

    Route::post('/kost/{kost}/booking',
        [BookingController::class, 'store'])
        ->name('booking.store');
});

/*
|--------------------------------------------------------------------------
| Dashboard (NETRAL, TIDAK REDIRECT)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return Auth::user()->role === 'owner'
        ? view('dashboard-owner')
        : view('dashboard-seeker');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Owner Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        Route::resource('kost', KostController::class);

        Route::get('/bookings',
            [KostController::class, 'bookings'])
            ->name('bookings.index');
    });

require __DIR__.'/auth.php';
