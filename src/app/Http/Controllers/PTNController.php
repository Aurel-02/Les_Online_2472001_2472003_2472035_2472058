<?php

namespace App\Http\Controllers;

use App\Pattern\PTN\PTNRepositoryInterface;
use App\Services\UserSession;
use Illuminate\Http\Request;

class PTNController extends Controller
{
    protected $ptnRepository;

    /**
     * Constructor injection for PTN Repository.
     *
     * @param PTNRepositoryInterface $ptnRepository
     */
    public function __construct(PTNRepositoryInterface $ptnRepository)
    {
        $this->ptnRepository = $ptnRepository;
    }

    public function index(Request $request)
    {
        $session      = UserSession::getInstance();
        $user         = $session->getUser();
        if ($user && in_array((int)$user->id_jenjang, [1, 2])) {
            abort(403, 'Akses ditolak.');
        }
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $search   = $request->query('search', '');
        $kategori = $request->query('kategori', 'semua');
        
        $ptns = $this->ptnRepository->getAllPTN();

        return view('siswa.ptn', compact('userName', 'photoProfile', 'search', 'kategori', 'ptns'));
    }

    public function jurusan(Request $request)
    {
        $session      = UserSession::getInstance();
        $user         = $session->getUser();
        if ($user && in_array((int)$user->id_jenjang, [1, 2])) {
            abort(403, 'Akses ditolak.');
        }
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $nama = $request->query('nama', '');
        $fakultasData = $this->ptnRepository->getAllFakultas();

        return view('siswa.jurusan', compact('userName', 'photoProfile', 'nama', 'fakultasData'));
    }

    public function jurusanDetail(Request $request)
    {
        $session      = UserSession::getInstance();
        $user         = $session->getUser();
        if ($user && in_array((int)$user->id_jenjang, [1, 2])) {
            abort(403, 'Akses ditolak.');
        }
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $nama = $request->query('nama', '');
        $jurusanDetail = $this->ptnRepository->getJurusanDetail($nama);

        return view('siswa.jurusan_detail', compact('userName', 'photoProfile', 'nama', 'jurusanDetail'));
    }
}
