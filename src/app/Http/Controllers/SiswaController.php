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
        $photoProfile = $session->getPhotoProfile();

        return view('siswa.home', compact('userName', 'userEmail', 'userRole', 'userJenjang', 'photoProfile'));
    }

    public function daftarMateri(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        $mapel = $request->query('mapel', 'Matematika');
        
        return view('siswa.materi', compact('userName', 'mapel', 'photoProfile'));
    }
    public function chat(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        return view('siswa.chat', compact('userName', 'photoProfile'));
    }

    public function paketBelajar(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        return view('siswa.paket_belajar', compact('userName', 'photoProfile'));
    }

    public function notifikasi(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        return view('siswa.notifikasi', compact('userName', 'photoProfile'));
    }
}
