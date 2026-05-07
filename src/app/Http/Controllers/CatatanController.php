<?php

namespace App\Http\Controllers;

use App\Services\UserSession;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        $session = UserSession::getInstance();
        if (!$session->isSiswa()) {
            abort(403, 'Akses ditolak. Halaman ini khusus untuk siswa.');
        }
        $userName = $session->getName();
        return view('siswa.catatan', compact('userName'));
    }

    // ─── [SEMENTARA] Preview tanpa auth — hapus setelah development ───────────
    public function preview()
    {
        $userName = 'Preview Siswa';
        return view('siswa.catatan', compact('userName'));
    }
}
