<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\PublicKostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ChatController;

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
| Auth User Routes (Seeker & Owner)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // ===============================
    // REVIEW
    // ===============================


    // ===============================
    // BOOKING (SEEKER)
    // ===============================
    Route::post('/kost/{kost}/booking',
        [BookingController::class, 'store'])
        ->name('booking.store');

    // 🔹 BOOKING SAYA (SEEKER)
    Route::get('/my-bookings',
        [BookingController::class, 'myBookings'])
        ->name('booking.my');

    // ===============================
    // CHAT (BERDASARKAN BOOKING)
    // ===============================
    Route::get('/chat/{booking}',
        [ChatController::class, 'show'])
        ->name('chat.show');

    Route::post('/chat/{booking}',
        [ChatController::class, 'store'])
        ->name('chat.store');
});

/*
|--------------------------------------------------------------------------
| Dashboard (Netral)
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
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
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

        // CRUD Kost
        Route::resource('kost', KostController::class);

        // Booking Masuk (Owner)
        Route::get('/bookings',
            [BookingController::class, 'ownerIndex'])
            ->name('bookings.index');

        // ACC / TOLAK Booking
        Route::post('/bookings/{booking}/approve',
            [BookingController::class, 'approve'])
            ->name('bookings.approve');

        Route::post('/bookings/{booking}/reject',
            [BookingController::class, 'reject'])
            ->name('bookings.reject');
    });

require __DIR__.'/auth.php';
