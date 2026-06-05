<?php

namespace App\Http\Controllers;

use App\Models\JadwalMengajar;
use App\Models\Materi;
use App\Models\Tugas;
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
        $totalTugas  = Tugas::where('id_guru', $s['userId'])->count();

        $hariIni = now()->locale('id')->dayName; // e.g. "Jumat"
        // Mapping nama hari Indonesia ke enum DB
        $hariMap = [
            'Senin'  => 'Senin',  'Selasa' => 'Selasa', 'Rabu'   => 'Rabu',
            'Kamis'  => 'Kamis',  'Jumat'  => 'Jumat',  'Sabtu'  => 'Sabtu',
            'Minggu' => 'Minggu',
        ];
        $hariDb = $hariMap[$hariIni] ?? null;
        $jadwalHariIni = $hariDb
            ? JadwalMengajar::where('id_guru', $s['userId'])->where('hari', $hariDb)->orderBy('jam_mulai')->get()
            : collect();

        // Tugas yang deadline-nya ≤ 3 hari lagi
        $tugasDeadlineDekat = Tugas::where('id_guru', $s['userId'])
            ->whereDate('deadline', '>=', now())
            ->whereDate('deadline', '<=', now()->addDays(3))
            ->orderBy('deadline')
            ->get();

        return view('guru.dashboard', compact(
            'totalMateri', 'totalTugas', 'jadwalHariIni', 'tugasDeadlineDekat'
        ) + ['userName' => $s['userName'], 'photoProfile' => $s['photoProfile']]);
    }

    // ─── SISWA ───────────────────────────────────────────────────────────────
    public function daftarSiswa()
    {
        $s        = $this->sessionData();
        $siswaList = User::where('role', 'siswa')->get();
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
            'kelas'       => 'nullable|string|max:100',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;
        $filePath = null;

        if ($request->hasFile('file_materi')) {
            $filePath = $request->file('file_materi')->store('materi', 'public');
        }

        Materi::create([
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'link_video'  => $request->link_video,
            'jenjang'     => $request->jenjang,
            'mapel'       => $request->mapel,
            'kelas'       => $request->kelas,
            'file_materi' => $filePath,
            'id_guru'     => $userId,
        ]);

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
            'kelas'       => 'nullable|string|max:100',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx|max:10240',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;
        $materi = Materi::where('id_materi', $id)->where('id_guru', $userId)->firstOrFail();

        $filePath = $materi->file_materi;
        if ($request->hasFile('file_materi')) {
            if ($filePath) Storage::disk('public')->delete($filePath);
            $filePath = $request->file('file_materi')->store('materi', 'public');
        }

        $materi->update([
            'judul'       => $request->judul,
            'deskripsi'   => $request->deskripsi,
            'link_video'  => $request->link_video,
            'jenjang'     => $request->jenjang,
            'mapel'       => $request->mapel,
            'kelas'       => $request->kelas,
            'file_materi' => $filePath,
        ]);

        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil diperbarui!');
    }

    public function materiDestroy($id)
    {
        $userId = UserSession::getInstance()->getUser()->id_user;
        $materi = Materi::where('id_materi', $id)->where('id_guru', $userId)->firstOrFail();
        if ($materi->file_materi) Storage::disk('public')->delete($materi->file_materi);
        $materi->delete();
        return redirect()->route('guru.materi.index')->with('success', 'Materi berhasil dihapus!');
    }

    // ─── TUGAS CRUD ──────────────────────────────────────────────────────────
    public function tugasIndex()
    {
        $s         = $this->sessionData();
        $tugasList = Tugas::where('id_guru', $s['userId'])->latest()->get();
        return view('guru.tugas.index', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
            'tugasList'    => $tugasList,
        ]);
    }

    public function tugasCreate()
    {
        $s = $this->sessionData();
        return view('guru.tugas.form', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
        ]);
    }

    public function tugasStore(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'deadline'   => 'required|date|after:now',
            'kelas'      => 'required|string|max:100',
            'mapel'      => 'required|string|max:100',
            'file_tugas' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $userId   = UserSession::getInstance()->getUser()->id_user;
        $filePath = null;

        if ($request->hasFile('file_tugas')) {
            $filePath = $request->file('file_tugas')->store('tugas', 'public');
        }

        Tugas::create([
            'judul'      => $request->judul,
            'deskripsi'  => $request->deskripsi,
            'deadline'   => $request->deadline,
            'kelas'      => $request->kelas,
            'mapel'      => $request->mapel,
            'file_tugas' => $filePath,
            'id_guru'    => $userId,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil ditambahkan!');
    }

    public function tugasEdit($id)
    {
        $s     = $this->sessionData();
        $tugas = Tugas::where('id_tugas', $id)->where('id_guru', $s['userId'])->firstOrFail();
        return view('guru.tugas.form', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
            'tugas'        => $tugas,
        ]);
    }

    public function tugasUpdate(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'deskripsi'  => 'nullable|string',
            'deadline'   => 'required|date',
            'kelas'      => 'required|string|max:100',
            'mapel'      => 'required|string|max:100',
            'file_tugas' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,zip|max:20480',
        ]);

        $userId   = UserSession::getInstance()->getUser()->id_user;
        $tugas    = Tugas::where('id_tugas', $id)->where('id_guru', $userId)->firstOrFail();
        $filePath = $tugas->file_tugas;

        if ($request->hasFile('file_tugas')) {
            if ($filePath) Storage::disk('public')->delete($filePath);
            $filePath = $request->file('file_tugas')->store('tugas', 'public');
        }

        $tugas->update([
            'judul'      => $request->judul,
            'deskripsi'  => $request->deskripsi,
            'deadline'   => $request->deadline,
            'kelas'      => $request->kelas,
            'mapel'      => $request->mapel,
            'file_tugas' => $filePath,
        ]);

        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil diperbarui!');
    }

    public function tugasDestroy($id)
    {
        $userId = UserSession::getInstance()->getUser()->id_user;
        $tugas  = Tugas::where('id_tugas', $id)->where('id_guru', $userId)->firstOrFail();
        if ($tugas->file_tugas) Storage::disk('public')->delete($tugas->file_tugas);
        $tugas->delete();
        return redirect()->route('guru.tugas.index')->with('success', 'Tugas berhasil dihapus!');
    }

    // ─── JADWAL MENGAJAR CRUD ─────────────────────────────────────────────────
    public function jadwalIndex()
    {
        $s           = $this->sessionData();
        $hariOrder   = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
        $jadwalList  = JadwalMengajar::where('id_guru', $s['userId'])
            ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
            ->orderBy('jam_mulai')
            ->get();

        return view('guru.jadwal.index', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
            'jadwalList'   => $jadwalList,
            'hariOrder'    => $hariOrder,
        ]);
    }

    public function jadwalCreate()
    {
        $s = $this->sessionData();
        return view('guru.jadwal.form', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
        ]);
    }

    public function jadwalStore(Request $request)
    {
        $request->validate([
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'mapel'       => 'required|string|max:100',
            'kelas'       => 'required|string|max:100',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;

        JadwalMengajar::create([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'mapel'       => $request->mapel,
            'kelas'       => $request->kelas,
            'id_guru'     => $userId,
        ]);

        return redirect()->route('guru.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
    }

    public function jadwalEdit($id)
    {
        $s      = $this->sessionData();
        $jadwal = JadwalMengajar::where('id_jadwal', $id)->where('id_guru', $s['userId'])->firstOrFail();
        return view('guru.jadwal.form', [
            'userName'     => $s['userName'],
            'photoProfile' => $s['photoProfile'],
            'jadwal'       => $jadwal,
        ]);
    }

    public function jadwalUpdate(Request $request, $id)
    {
        $request->validate([
            'hari'        => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
            'mapel'       => 'required|string|max:100',
            'kelas'       => 'required|string|max:100',
        ]);

        $userId = UserSession::getInstance()->getUser()->id_user;
        $jadwal = JadwalMengajar::where('id_jadwal', $id)->where('id_guru', $userId)->firstOrFail();

        $jadwal->update([
            'hari'        => $request->hari,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'mapel'       => $request->mapel,
            'kelas'       => $request->kelas,
        ]);

        return redirect()->route('guru.jadwal.index')->with('success', 'Jadwal berhasil diperbarui!');
    }

    public function jadwalDestroy($id)
    {
        $userId = UserSession::getInstance()->getUser()->id_user;
        $jadwal = JadwalMengajar::where('id_jadwal', $id)->where('id_guru', $userId)->firstOrFail();
        $jadwal->delete();
        return redirect()->route('guru.jadwal.index')->with('success', 'Jadwal berhasil dihapus!');
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