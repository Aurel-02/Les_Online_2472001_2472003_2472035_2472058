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
    Route::get('/siswa/catatan', [CatatanController::class, 'index'])->name('siswa.catatan');
    Route::get('/siswa/catatan/tulis', [CatatanController::class, 'create'])->name('siswa.catatan.tulis');
    Route::get('/siswa/catatan/edit/{id}', [CatatanController::class, 'edit'])->name('siswa.catatan.edit');
    Route::post('/siswa/catatan/simpan', [CatatanController::class, 'store'])->name('siswa.catatan.store');
    Route::get('/siswa/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('siswa.profile');
    Route::post('/siswa/profile/update', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('siswa.profile.update');
    Route::post('/siswa/profile/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('siswa.profile.photo');
    Route::get('/siswa/profile/password', [\App\Http\Controllers\ProfileController::class, 'showChangePasswordForm'])->name('siswa.profile.password');
    Route::post('/siswa/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('siswa.profile.password.update');
    Route::get('/siswa/ptn', [PTNController::class, 'index'])->name('siswa.ptn');
    Route::get('/siswa/fakultas', [PTNController::class, 'jurusan'])->name('siswa.fakultas');
    Route::get('/siswa/rekomendasi', [\App\Http\Controllers\RekomendasiJurusanController::class, 'index'])->name('siswa.jurusan');
    Route::get('/siswa/jurusan/detail', [PTNController::class, 'jurusanDetail'])->name('siswa.jurusan.detail');
    Route::get('/siswa/chat', [SiswaController::class, 'chat'])->name('siswa.chat');
    Route::get('/siswa/paket-belajar', [SiswaController::class, 'paketBelajar'])->name('siswa.paket-belajar');
    Route::post('/siswa/transaksi', [SiswaController::class, 'storeTransaksi'])->name('siswa.transaksi.store');
    Route::get('/siswa/notifikasi', [SiswaController::class, 'notifikasi'])->name('siswa.notifikasi');
    Route::post('/siswa/set-kelas', [SiswaController::class, 'setKelas'])->name('siswa.set-kelas');
    Route::get('/siswa/ujian', [\App\Http\Controllers\UjianController::class, 'index'])->name('siswa.ujian');
    Route::get('/siswa/ujian/{jenis}/mapel', [\App\Http\Controllers\UjianController::class, 'pilihMapel'])->name('siswa.ujian.mapel');
    Route::get('/siswa/ujian/{jenis}/{mapel}/persiapan', [\App\Http\Controllers\UjianController::class, 'persiapan'])->name('siswa.ujian.persiapan');
    Route::get('/siswa/ujian/{jenis}/{mapel}/soal', [\App\Http\Controllers\UjianController::class, 'soal'])->name('siswa.ujian.soal');
    Route::post('/siswa/ujian/submit', [\App\Http\Controllers\UjianController::class, 'submit'])->name('siswa.ujian.submit');
    Route::get('/siswa/ujian/review/{id}', [\App\Http\Controllers\UjianController::class, 'review'])->name('siswa.ujian.review');
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

Route::middleware(['auth', 'role:orang tua'])->group(function () {
    Route::get('/orangtua/home', [\App\Http\Controllers\OrangTuaController::class, 'index'])->name('orangtua.home');
});