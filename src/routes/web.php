<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CatatanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\PTNController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Account deactivated routes
Route::get('/account-deactivated/{id}', [AuthController::class, 'showDeactivated'])->name('account.deactivated');
Route::post('/request-reactivation/{id}', [AuthController::class, 'requestReactivation'])->name('account.reactivate.request');

// ─── Chat API (shared siswa & guru) ──────────────────────────────────────────
Route::middleware(['auth'])->prefix('chat')->group(function () {
    Route::get('/contacts', [ChatController::class, 'contacts'])->name('chat.contacts');
    Route::get('/messages/{contactId}', [ChatController::class, 'messages'])->name('chat.messages');
    Route::post('/send', [ChatController::class, 'send'])->name('chat.send');
    Route::get('/poll/{contactId}', [ChatController::class, 'poll'])->name('chat.poll');
});


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

    // Chat
    Route::get('/guru/chat', [GuruController::class, 'chat'])->name('guru.chat');

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
    Route::get('/orangtua/profile', [\App\Http\Controllers\ProfileController::class, 'indexOrangTua'])->name('orangtua.profile');
    Route::post('/orangtua/profile/update', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('orangtua.profile.update');
    Route::post('/orangtua/profile/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('orangtua.profile.photo');
    Route::get('/orangtua/profile/password', [\App\Http\Controllers\ProfileController::class, 'showChangePasswordFormOrangTua'])->name('orangtua.profile.password');
    Route::post('/orangtua/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePasswordOrangTua'])->name('orangtua.profile.password.update');
    Route::get('/orangtua/paket-belajar', [\App\Http\Controllers\OrangTuaController::class, 'paketBelajar'])->name('orangtua.paket-belajar');
    Route::post('/orangtua/transaksi', [\App\Http\Controllers\OrangTuaController::class, 'storeTransaksi'])->name('orangtua.transaksi.store');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pengguna', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/admin/pengguna/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::put('/admin/pengguna/{id}/restore', [AdminController::class, 'restoreUser'])->name('admin.users.restore');
    Route::get('/admin/notifikasi', [AdminController::class, 'notifications'])->name('admin.notifications');
    Route::get('/admin/transaksi', [AdminController::class, 'transactions'])->name('admin.transactions');
    
    // Promo / Voucher Management
    Route::get('/admin/promo', [AdminController::class, 'promoIndex'])->name('admin.promo.index');
    Route::post('/admin/promo', [AdminController::class, 'promoStore'])->name('admin.promo.store');
    Route::delete('/admin/promo/{id}', [AdminController::class, 'promoDestroy'])->name('admin.promo.destroy');
    
    // Paket Belajar Management
    Route::get('/admin/paket', [AdminController::class, 'paketIndex'])->name('admin.paket.index');
    Route::post('/admin/paket', [AdminController::class, 'paketStore'])->name('admin.paket.store');
    Route::delete('/admin/paket/{id}', [AdminController::class, 'paketDestroy'])->name('admin.paket.destroy');

    Route::get('/admin/profile', [\App\Http\Controllers\ProfileController::class, 'indexAdmin'])->name('admin.profile');
    Route::post('/admin/profile/update', [\App\Http\Controllers\ProfileController::class, 'updateProfile'])->name('admin.profile.update');
    Route::post('/admin/profile/photo', [\App\Http\Controllers\ProfileController::class, 'updatePhoto'])->name('admin.profile.photo');
    Route::get('/admin/profile/password', [\App\Http\Controllers\ProfileController::class, 'showChangePasswordFormAdmin'])->name('admin.profile.password');
    Route::post('/admin/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePasswordAdmin'])->name('admin.profile.password.update');
});