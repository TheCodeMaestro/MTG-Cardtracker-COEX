<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [CardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/trackedcards', function () {
//     return view('trackedcards');
// })->middleware(['auth', 'verified'])->name('trackedcards');

Route::get('/trackedcards', [CardController::class, 'showTrackedCards'])->middleware(['auth', 'verified'])->name('trackedcards');

Route::middleware('auth')->group(function () {
    Route::post('/cards/{card}/track', [CardController::class, 'track'])->name('cards.track');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
