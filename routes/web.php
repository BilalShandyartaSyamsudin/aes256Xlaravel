<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncryptDecryptController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FileEncryptController;

Route::get('/', [HomeController::class, 'show'])->name('home.show');
Route::get('/encrypt-decrypt', [EncryptDecryptController::class, 'show'])->name('text-encrypt.show');
Route::post('/encrypt-decrypt', [EncryptDecryptController::class, 'process'])->name('process');
Route::get('file-encrypt', [FileEncryptController::class, 'show'])->name('file-encrypt.show');

