<?php

namespace App\Http\Controllers;

use App\Services\UserSession;
use Illuminate\Http\Request;

class PTNController extends Controller
{
    public function index(Request $request)
    {
        $session      = UserSession::getInstance();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $search   = $request->query('search', '');
        $kategori = $request->query('kategori', 'semua');

        return view('siswa.ptn', compact('userName', 'photoProfile', 'search', 'kategori'));
    }

    public function jurusan(Request $request)
    {
        $session      = UserSession::getInstance();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $nama = $request->query('nama', '');

        return view('siswa.jurusan', compact('userName', 'photoProfile', 'nama'));
    }
}
