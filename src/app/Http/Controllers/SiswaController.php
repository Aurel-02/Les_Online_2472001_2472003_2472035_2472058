<?php

namespace App\Http\Controllers;

use App\Services\UserSession; // ← SINGLETON: Import kelas UserSession
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        // ─── SINGLETON: Ambil instance tunggal UserSession ───────────────────
        // getInstance() selalu mengembalikan objek yang SAMA (tidak membuat baru).
        // Ini adalah penggunaan Singleton Pattern di sisi controller.
        $session = UserSession::getInstance();

        // ─── SINGLETON: Proteksi akses — hanya role 'siswa' yang boleh masuk ───
        // Menggunakan isSiswa() dari instance singleton yang sudah ada.
        if (!$session->isSiswa()) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk siswa.');
        }

        // ─── SINGLETON: Ambil data pengguna dari instance singleton ───
        $userName  = $session->getName();
        $userEmail = $session->getEmail();
        $userRole  = $session->getRole();

        return view('siswa.home', compact('userName', 'userEmail', 'userRole'));
    }

    public function video()
    {
        $session = UserSession::getInstance();
        if (!$session->isSiswa()) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk siswa.');
        }
        $userName = $session->getName();
        return view('siswa.video', compact('userName'));
    }


    public function videoPreview()
    {
        $userName = 'Preview Siswa';
        return view('siswa.video', compact('userName'));
    }
}
