<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParfumController; 
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [ParfumController::class, 'index'])->name('dashboard');
Route::get('/parfum/{id}', [ParfumController::class, 'show'])->name('parfum.show');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Management Parfum
    Route::get('/create', [ParfumController::class, 'create'])->name('parfum.create');
    Route::post('/store', [ParfumController::class, 'store'])->name('parfum.store');
    Route::get('/edit/{id}', [ParfumController::class, 'edit'])->name('parfum.edit');
    
    // Perbaikan: Gunakan PUT untuk update dan DELETE untuk hapus
    Route::put('/update/{id}', [ParfumController::class, 'update'])->name('parfum.update');
    Route::delete('/delete/{id}', [ParfumController::class, 'destroy'])->name('parfum.destroy');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk Management Training
Route::middleware(['auth'])->group(function () {
    Route::get('/training/create', [ParfumController::class, 'createTraining'])->name('training.create');
    Route::post('/training/store', [ParfumController::class, 'storeTraining'])->name('training.store');
    
    Route::get('/training/edit/{id}', [ParfumController::class, 'editTraining'])->name('training.edit');
    Route::put('/training/update/{id}', [ParfumController::class, 'updateTraining'])->name('training.update');

    // Perbaikan: Konsistensi nama route destroy training
    Route::delete('/training/delete/{id}', [ParfumController::class, 'destroyTraining'])->name('training.destroy');
});

require __DIR__.'/auth.php';