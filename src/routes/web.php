<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ─── Route untuk Siswa (dilindungi middleware auth) ───────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/siswa/home', [SiswaController::class, 'index'])->name('siswa.home');
});

// ─── [SEMENTARA] Route video tanpa auth — untuk preview/development ───────────
Route::get('/siswa/video', [SiswaController::class, 'videoPreview'])->name('siswa.video');
