<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::middleware(['auth'])->group(function () {
    // Event routes
    Route::resource('events', EventController::class);
});
require __DIR__.'/auth.php';
