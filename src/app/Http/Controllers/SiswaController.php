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
        
        $user = $session->getUser();
        $userJenjang = $user ? $user->id_jenjang : 3;
        $photoProfile = $session->getPhotoProfile();

        $activities = collect();
        if ($user) {
            $activities = \App\Models\Activity::where('user_id', $user->getKey())
                            ->orderBy('created_at', 'desc')
                            ->take(5)
                            ->get();
        }

        return view('siswa.home', compact('userName', 'userEmail', 'userRole', 'userJenjang', 'photoProfile', 'activities'));
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

    public function setKelas(Request $request)
    {
        $request->validate([
            'kelas' => 'required|integer',
            'jurusan' => 'nullable|string'
        ]);

        session(['selected_kelas' => $request->kelas]);
        
        if ($request->has('jurusan')) {
            session(['selected_jurusan' => $request->jurusan]);
        }
        
        return response()->json(['success' => true]);
    }
}
