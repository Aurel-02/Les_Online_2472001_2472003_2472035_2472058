<?php

namespace App\Http\Controllers;

use App\Services\UserSession; 
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $session = UserSession::getInstance();

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
        
        $user = $session->getUser();
        $idJenjang = $user ? $user->id_jenjang : null;
        
        $jenjangName = null;
        if ($idJenjang) {
            $jenjangName = \Illuminate\Support\Facades\DB::table('jenjang')->where('id_jenjang', $idJenjang)->value('nama_jenjang');
        }

        if ($jenjangName) {
            $paketList = \Illuminate\Support\Facades\DB::table('paket_pembelajaran')->where('jenjang', $jenjangName)->get();
        } else {
            $paketList = \Illuminate\Support\Facades\DB::table('paket_pembelajaran')->get();
        }
        
        return view('siswa.paket_belajar', compact('userName', 'photoProfile', 'paketList', 'jenjangName'));
    }

    public function notifikasi(Request $request)
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        
        return view('siswa.notifikasi', compact('userName', 'photoProfile'));
    }
}
