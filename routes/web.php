<?php

use App\Http\Controllers\BookControllerV1;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShelfControllerV1;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BookControllerV1::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::name('v1.books.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/books', [BookControllerV1::class, 'create'])
        ->name('create');
    Route::post('/books', [BookControllerV1::class, 'store'])
        ->name('store');
    Route::get('/books/{book}', [BookControllerV1::class, 'edit'])
        ->middleware('can:update,book')
        ->name('edit');
    Route::patch('/books/{book}', [BookControllerV1::class, 'update'])
        ->middleware('can:update,book')
        ->name('update');
    Route::delete('/books/{book}', [BookControllerV1::class, 'destroy'])
        ->middleware('can:delete,book')
        ->name('destroy');
});

Route::name('v1.shelves.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/shelves', [ShelfControllerV1::class, 'index'])
        ->name('index');
    Route::get('/shelves/{shelf}', [ShelfControllerV1::class, 'showBooks'])
        ->name('shelves.showBooks');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__ . '/auth.php';
