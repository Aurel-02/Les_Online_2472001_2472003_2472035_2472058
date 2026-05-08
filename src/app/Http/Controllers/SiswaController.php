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
        $userJenjang = $session->getUser()->id_jenjang;

        return view('siswa.home', compact('userName', 'userEmail', 'userRole', 'userJenjang'));
    }

    public function daftarMateri(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $mapel = $request->query('mapel', 'Matematika');
        
        return view('siswa.materi', compact('userName', 'mapel'));
    }
}
