<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BookController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/add-book', [BookController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('add-book');

Route::post('/add-book', [BookController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('add-book');

Route::get('/edit-book/{book}', [BookController::class, 'edit'])
    ->middleware(['auth', 'verified', 'can:update,book'])
    ->name('edit-book');

Route::put('/edit-book/{book}', [BookController::class, 'update'])
    ->middleware(['auth', 'verified', 'can:update,book'])
    ->name('edit-book');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
