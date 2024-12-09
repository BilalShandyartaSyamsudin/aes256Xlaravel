<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EncryptDecryptController;
use App\Http\Controllers\FileEncryptController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AuthController;


Route::get('/home', [HomeController::class, 'show'])->middleware(['auth', 'verified'])->name('home.show');
Route::get('/data-show', [HomeController::class, 'showData'])->name('home.showData'); 
Route::get('/encrypt-decrypt', [EncryptDecryptController::class, 'show'])->name('text-encrypt.show');
Route::post('/encrypt-decrypt', [EncryptDecryptController::class, 'process'])->name('process');
Route::get('/file-encrypt', [FileEncryptController::class, 'show'])->name('file-encrypt.show');
Route::get('/data', [DataController::class, 'show'])->name('data.show');
Route::post('/data', [DataController::class, 'data'])->name('data.submit');
Route::get('/auth', [AuthController::class, 'show'])->name('auth');
Route::view('/verify', 'verify.verify');

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
