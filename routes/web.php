<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EncryptDecryptController;
use App\Http\Controllers\FileEncryptController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\AuthController;


Route::get('/', [HomeController::class, 'show'])->name('home.show'); // Rute untuk halaman home utama
Route::get('/data-show', [HomeController::class, 'showData'])->name('home.showData'); 
Route::get('/encrypt-decrypt', [EncryptDecryptController::class, 'show'])->name('text-encrypt.show');
Route::post('/encrypt-decrypt', [EncryptDecryptController::class, 'process'])->name('process');
Route::get('/file-encrypt', [FileEncryptController::class, 'show'])->name('file-encrypt.show');
Route::get('/data', [DataController::class, 'show'])->name('data.show');
Route::post('/data', [DataController::class, 'data'])->name('data.submit');
Route::get('/auth', [AuthController::class, 'show'])->name('auth');
