<?php

namespace App\Http\Controllers;

use App\Models\Materi;
use App\Models\User;
use App\Services\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    // ─── HELPER: data sesi ───────────────────────────────────────────────────
    private function sessionData(): array
    {
        $session = UserSession::getInstance();
        return [
            'userName'     => $session->getName(),
            'photoProfile' => $session->getPhotoProfile(),
            'userId'       => $session->getUser()->id_user,
        ];
    }

    // ─── DASHBOARD ───────────────────────────────────────────────────────────
    public function dashboard()
    {
        $s = $this->sessionData();

        $totalMateri = Materi::where('id_guru', $s['userId'])->count();
        return view('guru.dashboard', compact('totalMateri') + ['userName' => $s['userName'], 'photoProfile' => $s['photoProfile']]);
    }

    // ─── SISWA ───────────────────────────────────────────────────────────────
    public function daftarSiswa()
    {
        $s        = $this->sessionData();
        $siswaList = User::where('role', 'siswa')
            ->leftJoin('jenjang', 'user.id_jenjang', '=', 'jenjang.id_jenjang')
            ->select('user.*', 'jenjang.nama_jenjang')
            ->get();
        return view('guru.siswa.index', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
            'siswaList'    => $siswaList,
        ]);
    }

    // ─── MATERI CRUD ─────────────────────────────────────────────────────────
    public function materiIndex()
    {
        $s          = $this->sessionData();
        $materiList = Materi::where('id_guru', $s['userId'])->latest()->get();
        return view('guru.materi.index', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
            'materiList'   => $materiList,
        ]);
    }

    public function materiCreate()
    {
        $s = $this->sessionData();
        return view('guru.materi.form', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
        ]);
    }

    public function materiStore(Request $request)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'link_video'  => 'nullable|url',
            'jenjang'     => 'required|in:SD,SMP,SMA',
            'mapel'       => 'nullable|string|max:100',
            'kelas'       => 'required|integer',
            'jurusan'     => 'nullable|string|in:ipa,ips,semua',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;
        $file = $request->file('file_materi');
        $data = $request->only(['judul', 'deskripsi', 'link_video', 'jenjang', 'mapel', 'kelas', 'jurusan']);
        $data['id_guru'] = $userId;

        $command = new \App\Pattern\Command\Materi\CreateMateriCommand($data, $file);
        $command->execute();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil ditambahkan!');
    }

    public function materiEdit($id)
    {
        $s      = $this->sessionData();
        $materi = Materi::where('id_materi', $id)->where('id_guru', $s['userId'])->firstOrFail();
        return view('guru.materi.form', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
            'materi'       => $materi,
        ]);
    }

    public function materiUpdate(Request $request, $id)
    {
        $request->validate([
            'judul'       => 'required|string|max:255',
            'deskripsi'   => 'nullable|string',
            'link_video'  => 'nullable|url',
            'jenjang'     => 'required|in:SD,SMP,SMA',
            'mapel'       => 'nullable|string|max:100',
            'kelas'       => 'required|integer',
            'jurusan'     => 'nullable|string|in:ipa,ips,semua',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;
        $file = $request->file('file_materi');
        $data = $request->only(['judul', 'deskripsi', 'link_video', 'jenjang', 'mapel', 'kelas', 'jurusan']);

        $command = new \App\Pattern\Command\Materi\UpdateMateriCommand($id, $userId, $data, $file);
        $command->execute();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function materiDestroy($id)
    {
        $userId = UserSession::getInstance()->getUser()->id_user;
        
        $command = new \App\Pattern\Command\Materi\DeleteMateriCommand($id, $userId);
        $command->execute();

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    public function chat()
    {
        $s = $this->sessionData();
        return view('guru.chat', [
            'userName' => $s['userName'],
            'photoProfile' => $s['photoProfile'],
        ]);
    }
}