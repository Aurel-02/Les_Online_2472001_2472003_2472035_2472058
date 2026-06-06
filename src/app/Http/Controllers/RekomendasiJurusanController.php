<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pattern\Rekomendasi\RekomendasiStrategy;
use App\Services\UserSession;

class RekomendasiJurusanController extends Controller
{
    protected $strategy;

    public function __construct(RekomendasiStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        if ($user && in_array((int)$user->id_jenjang, [1, 2])) {
            abort(403, 'Akses ditolak.');
        }
        
        $session      = UserSession::getInstance();
        $userName     = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $data = $this->strategy->getRekomendasi($user);

        return view('siswa.rekomendasi', array_merge([
            'userName' => $userName,
            'photoProfile' => $photoProfile,
        ], $data));
    }
}
