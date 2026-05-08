<?php

namespace App\Http\Controllers;

use App\Services\UserSession;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        return view('siswa.video', compact('userName'));
    }

    // ─── [SEMENTARA] Preview tanpa auth — hapus setelah development ───────────
    public function preview()
    {
        $userName = 'Preview Siswa';
        return view('siswa.video', compact('userName'));
    }
}
