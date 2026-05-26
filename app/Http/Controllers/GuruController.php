<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\User;
use App\Services\UserSession;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function dashboard()
    {
        $session = UserSession::getInstance();
        $userName  = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        return view('guru.dashboard', compact('userName', 'photoProfile'));
    }

    // --- SISWA ---
    public function daftarSiswa()
    {
        $session = UserSession::getInstance();
        $userName  = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $siswaList = User::where('role', 'siswa')->get();

        return view('guru.siswa.index', compact('userName', 'photoProfile', 'siswaList'));
    }

    // --- MATERI CRUD ---
    public function materiIndex()
    {
        $session = UserSession::getInstance();
        $userName  = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        $userId = $session->getUser()->id_user;

        $materiList = Materi::where('id_guru', $userId)->get();

        return view('guru.materi.index', compact('userName', 'photoProfile', 'materiList'));
    }

    public function materiCreate()
    {
        $session = UserSession::getInstance();
        $userName  = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        return view('guru.materi.form', compact('userName', 'photoProfile'));
    }

    public function materiStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link_video' => 'nullable|url',
            'jenjang' => 'required|in:SD,SMP,SMA',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;

        Materi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link_video' => $request->link_video,
            'jenjang' => $request->jenjang,
            'id_guru' => $userId,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function materiEdit($id)
    {
        $session = UserSession::getInstance();
        $userName  = $session->getName();
        $photoProfile = $session->getPhotoProfile();
        $userId = $session->getUser()->id_user;

        $materi = Materi::where('id_materi', $id)->where('id_guru', $userId)->firstOrFail();

        return view('guru.materi.form', compact('userName', 'photoProfile', 'materi'));
    }

    public function materiUpdate(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'link_video' => 'nullable|url',
            'jenjang' => 'required|in:SD,SMP,SMA',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;
        $materi = Materi::where('id_materi', $id)->where('id_guru', $userId)->firstOrFail();

        $materi->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'link_video' => $request->link_video,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function materiDestroy($id)
    {
        $userId = UserSession::getInstance()->getUser()->id_user;
        $materi = Materi::where('id_materi', $id)->where('id_guru', $userId)->firstOrFail();
        $materi->delete();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus!');
    }
}