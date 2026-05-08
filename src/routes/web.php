<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CatatanController;

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

// ─── Route untuk Siswa (dilindungi middleware auth & role) ───────────────────────────
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/siswa/home', [SiswaController::class, 'index'])->name('siswa.home');
    Route::get('/siswa/materi', [SiswaController::class, 'daftarMateri'])->name('siswa.materi');
    Route::get('/siswa/video', [VideoController::class, 'index'])->name('siswa.video');
    Route::get('/siswa/video/catatan', [CatatanController::class, 'index'])->name('siswa.catatan');
});
