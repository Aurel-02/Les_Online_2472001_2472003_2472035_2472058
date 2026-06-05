<?php

namespace App\Http\Controllers;

use App\Pattern\MateriFactory;
use App\Services\UserSession;
use App\Models\Activity;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        $session = UserSession::getInstance();
        $user    = $session->getUser();

        if ($user) {
            // Menggunakan Observer Pattern untuk Notifikasi
            \App\Pattern\Observer\ActivityNotifier::getInstance()->notify([
                'user_id'     => $user->getKey(),
                'type'        => 'catatan',
                'description' => 'Membuka daftar catatan',
            ]);
        }

        $materi = MateriFactory::create('catatan');
        return view($materi->getView(), $materi->getData());
    }

    public function create()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $mapel = request()->query('mapel', 'Umum');
        return view('siswa.catatan-tulis', [
            'userName' => $userName,
            'mapel' => $mapel,
            'photoProfile' => $session->getPhotoProfile()
        ]);
    }

    public function edit($id)
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();
        $userName = $session->getName();
        
        $catatan = \App\Models\Catatan::where('id_catatan', $id)
                    ->where('id_user', $user->getKey())
                    ->firstOrFail();

        return view('siswa.catatan-tulis', [
            'userName' => $userName,
            'mapel' => $catatan->mapel,
            'photoProfile' => $session->getPhotoProfile(),
            'catatan' => $catatan
        ]);
    }

    public function store(Request $request)
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();
        if (!$user) return redirect()->back();

        $request->validate([
            'judul' => 'required',
            'isi_catatan' => 'required',
            'mapel' => 'required'
        ]);

        $colors = ['sage', 'amber', 'mauve', 'blue'];
        $color = $colors[array_rand($colors)];

        if ($request->id_catatan) {
            $catatan = \App\Models\Catatan::where('id_catatan', $request->id_catatan)
                        ->where('id_user', $user->getKey())
                        ->first();
            if ($catatan) {
                $catatan->update([
                    'judul' => $request->judul,
                    'isi_catatan' => $request->isi_catatan,
                    'mapel' => $request->mapel
                ]);
            }
        } else {
            \App\Models\Catatan::create([
                'id_user' => $user->getKey(),
                'mapel' => $request->mapel,
                'judul' => $request->judul,
                'isi_catatan' => $request->isi_catatan,
                'cover_color' => $color
            ]);
        }

        return redirect()->route('siswa.catatan')->with('success', 'Catatan berhasil disimpan!');
    }
}
