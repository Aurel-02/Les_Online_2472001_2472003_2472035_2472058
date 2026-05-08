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

        // ─── SINGLETON: Ambil data pengguna dari instance singleton ───
        $userName  = $session->getName();
        $userEmail = $session->getEmail();
        $userRole  = $session->getRole();

        return view('siswa.home', compact('userName', 'userEmail', 'userRole'));
    }
}
