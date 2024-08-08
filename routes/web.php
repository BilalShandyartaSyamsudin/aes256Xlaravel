<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EncryptDecryptController;
use App\Http\Controllers\FileEncryptController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\CobaController;

Route::get('/', [HomeController::class, 'show'])->name('home.show');
Route::get('/encrypt-decrypt', [EncryptDecryptController::class, 'show'])->name('text-encrypt.show');
Route::post('/encrypt-decrypt', [EncryptDecryptController::class, 'process'])->name('process');
Route::get('/file-encrypt', [FileEncryptController::class, 'show'])->name('file-encrypt.show');
Route::get('/data', [DataController::class, 'show'])->name('data.show');
Route::post('/data', [DataController::class, 'data'])->name('data.submit');
Route::get('/coba', [CobaController::class, 'show'])->name('coba.show');
Route::post('/coba', [CobaController::class, 'cobaPost'])->name('coba.submit');
