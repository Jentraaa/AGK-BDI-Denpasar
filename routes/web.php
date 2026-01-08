<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParfumController; // Pastikan ini di-import
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/
Route::get('/', [ParfumController::class, 'index'])->name('dashboard');
Route::get('/parfum/{id}', [ParfumController::class, 'show'])->name('parfum.show');

/*
|--------------------------------------------------------------------------
| Admin Routes (Hanya untuk yang sudah Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Management Parfum
    Route::get('/create', [ParfumController::class, 'create'])->name('parfum.create');
    Route::post('/store', [ParfumController::class, 'store'])->name('parfum.store');
    Route::get('/edit/{id}', [ParfumController::class, 'edit'])->name('parfum.edit');
    Route::post('/update/{id}', [ParfumController::class, 'update'])->name('parfum.update');
    Route::get('/delete/{id}', [ParfumController::class, 'destroy'])->name('parfum.delete');

    // Profile Management (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route untuk Management Training
Route::middleware(['auth'])->group(function () {
    Route::get('/training/create', [ParfumController::class, 'createTraining']);
    Route::post('/training/store', [ParfumController::class, 'storeTraining']);
    Route::delete('/training/delete/{id}', [ParfumController::class, 'destroyTraining']);
});
require __DIR__.'/auth.php';