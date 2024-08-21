<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\Crypto\EncryptController;
use App\Http\Controllers\Crypto\DecryptController;


Route::get('/data-show', [HomeController::class, 'showData'])->name('home.showData'); 
Route::get('/data', [DataController::class, 'show'])->name('data.show');
Route::post('/data', [DataController::class, 'data'])->name('data.submit');
Route::get('/encrypt', [EncryptController::class, 'show'])->name('show.encrypt');
Route::get('/decrypt', [DecryptController::class, 'show'])->name('show.decrypt');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', [HomeController::class, 'show'])->middleware(['auth', 'verified'])->name('home.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
