<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PTNController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoucherController;

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
    Route::get('/siswa/jurusan/detail', [PTNController::class, 'jurusanDetail'])->name('siswa.jurusan.detail');
    Route::get('/siswa/chat', [SiswaController::class, 'chat'])->name('siswa.chat');
    Route::get('/siswa/paket-belajar', [SiswaController::class, 'paketBelajar'])->name('siswa.paket-belajar');
    Route::get('/siswa/notifikasi', [SiswaController::class, 'notifikasi'])->name('siswa.notifikasi');
    Route::post('/siswa/set-kelas', [SiswaController::class, 'setKelas'])->name('siswa.set-kelas');
    Route::get('/siswa/ujian', [\App\Http\Controllers\UjianController::class, 'index'])->name('siswa.ujian');
    Route::get('/siswa/ujian/{jenis}/mapel', [\App\Http\Controllers\UjianController::class, 'pilihMapel'])->name('siswa.ujian.mapel');
    Route::get('/siswa/ujian/{jenis}/{mapel}/persiapan', [\App\Http\Controllers\UjianController::class, 'persiapan'])->name('siswa.ujian.persiapan');
    Route::get('/siswa/ujian/{jenis}/{mapel}/soal', [\App\Http\Controllers\UjianController::class, 'soal'])->name('siswa.ujian.soal');
    Route::post('/siswa/ujian/submit', [\App\Http\Controllers\UjianController::class, 'submit'])->name('siswa.ujian.submit');
    Route::get('/siswa/ujian/review/{id}', [\App\Http\Controllers\UjianController::class, 'review'])->name('siswa.ujian.review');
});

Route::middleware(['auth', 'role:guru'])->group(function () {
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

// ─── Route untuk Admin ────────────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Manajemen Pengguna CRUD
    Route::get('/admin/pengguna', [AdminController::class, 'penggunaIndex'])->name('admin.pengguna.index');
    Route::get('/admin/pengguna/create', [AdminController::class, 'penggunaCreate'])->name('admin.pengguna.create');
    Route::post('/admin/pengguna', [AdminController::class, 'penggunaStore'])->name('admin.pengguna.store');
    Route::get('/admin/pengguna/{id}/edit', [AdminController::class, 'penggunaEdit'])->name('admin.pengguna.edit');
    Route::put('/admin/pengguna/{id}', [AdminController::class, 'penggunaUpdate'])->name('admin.pengguna.update');
    Route::delete('/admin/pengguna/{id}', [AdminController::class, 'penggunaDestroy'])->name('admin.pengguna.destroy');
    Route::patch('/admin/pengguna/{id}/status', [AdminController::class, 'penggunaToggleStatus'])->name('admin.pengguna.toggle-status');

    // Manajemen Voucher CRUD
    Route::get('/admin/voucher',              [VoucherController::class, 'index'])  ->name('admin.voucher.index');
    Route::get('/admin/voucher/create',       [VoucherController::class, 'create']) ->name('admin.voucher.create');
    Route::post('/admin/voucher',             [VoucherController::class, 'store'])  ->name('admin.voucher.store');
    Route::get('/admin/voucher/{id}/edit',    [VoucherController::class, 'edit'])   ->name('admin.voucher.edit');
    Route::put('/admin/voucher/{id}',         [VoucherController::class, 'update']) ->name('admin.voucher.update');
    Route::delete('/admin/voucher/{id}',      [VoucherController::class, 'destroy'])->name('admin.voucher.destroy');

    // Manajemen Paket CRUD
    Route::get('/admin/paket',              [\App\Http\Controllers\PaketController::class, 'index'])  ->name('admin.paket.index');
    Route::get('/admin/paket/create',       [\App\Http\Controllers\PaketController::class, 'create']) ->name('admin.paket.create');
    Route::post('/admin/paket',             [\App\Http\Controllers\PaketController::class, 'store'])  ->name('admin.paket.store');
    Route::delete('/admin/paket/{id}',      [\App\Http\Controllers\PaketController::class, 'destroy'])->name('admin.paket.destroy');
});