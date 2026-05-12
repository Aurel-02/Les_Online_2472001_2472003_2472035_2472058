<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PTNController;

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
    Route::get('/siswa/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('siswa.profile');
    Route::post('/siswa/profile/update', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('siswa.profile.update');
    Route::post('/siswa/profile/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('siswa.profile.photo');
    Route::get('/siswa/profile/password', [\App\Http\Controllers\ProfileController::class, 'showChangePasswordForm'])->name('siswa.profile.password');
    Route::post('/siswa/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('siswa.profile.password.update');
    Route::get('/siswa/ptn', [PTNController::class, 'index'])->name('siswa.ptn');
    Route::get('/siswa/jurusan', [PTNController::class, 'jurusan'])->name('siswa.jurusan');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/profile', [\App\Http\Controllers\ProfileController::class, 'indexGuru'])->name('guru.profile');
    Route::post('/guru/profile/update', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('guru.profile.update');
    Route::post('/guru/profile/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('guru.profile.photo');
    Route::get('/guru/profile/password', [\App\Http\Controllers\ProfileController::class, 'showChangePasswordFormGuru'])->name('guru.profile.password');
    Route::post('/guru/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePasswordGuru'])->name('guru.profile.password.update');

    // Siswa
    Route::get('/guru/siswa', [GuruController::class, 'daftarSiswa'])->name('guru.siswa.index');

    // Materi CRUD
    Route::get('/guru/materi', [GuruController::class, 'materiIndex'])->name('guru.materi.index');
    Route::get('/guru/materi/create', [GuruController::class, 'materiCreate'])->name('guru.materi.create');
    Route::post('/guru/materi', [GuruController::class, 'materiStore'])->name('guru.materi.store');
    Route::get('/guru/materi/{id}/edit', [GuruController::class, 'materiEdit'])->name('guru.materi.edit');
    Route::put('/guru/materi/{id}', [GuruController::class, 'materiUpdate'])->name('guru.materi.update');
    Route::delete('/guru/materi/{id}', [GuruController::class, 'materiDestroy'])->name('guru.materi.destroy');
});