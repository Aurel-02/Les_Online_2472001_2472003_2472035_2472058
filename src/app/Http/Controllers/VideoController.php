<?php

namespace App\Http\Controllers;

use App\Pattern\MateriFactory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $materi = MateriFactory::create('video');
        return view($materi->getView(), $materi->getData());
    }

    // ─── [SEMENTARA] Preview tanpa auth — hapus setelah development ───────────
    public function preview()
    {
        $userName = 'Preview Siswa';
        return view('siswa.video', compact('userName'));
    }
}
