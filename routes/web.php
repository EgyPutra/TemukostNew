<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\PublicKostController;

/*
|--------------------------------------------------------------------------
| Public Routes (Pencari Kost)
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicKostController::class, 'index'])->name('home');
Route::get('/kost/{kost}', [PublicKostController::class, 'show'])->name('kost.show');

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    return $role === 'owner'
        ? redirect()->route('owner.kost.index')
        : view('dashboard-seeker');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes (default Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Owner Routes (Pemilik Kost)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::resource('kost', KostController::class);
    });

require __DIR__.'/auth.php';
