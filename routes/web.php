<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterestedAccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('interessados', InterestedAccountController::class)->parameters(['interessados' => 'interessado']);
    });
});

require __DIR__.'/auth.php';

Route::fallback(fn () => response()->view('errors.404', [], 404));
