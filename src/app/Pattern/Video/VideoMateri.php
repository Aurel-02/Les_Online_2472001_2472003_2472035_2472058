<?php

namespace App\Pattern\Video;

use App\Pattern\MateriInterface;
use App\Services\UserSession;

class VideoMateri implements MateriInterface
{
    public function getView(): string
    {
        return 'siswa.video';
    }

    public function getData(): array
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        if (!$userName) {
            $userName = 'Siswa Pintar';
        }
        $mapel = request()->query('mapel', 'Matematika');
        $idMateri = request()->query('id');

        $materiData = null;
        $nextVideos = [];
        if ($idMateri) {
            $materiData = \Illuminate\Support\Facades\DB::table('materi')
                ->join('user', 'materi.id_guru', '=', 'user.id_user')
                ->where('materi.id_materi', $idMateri)
                ->select('materi.*', 'user.nama as nama_guru')
                ->first();
                
            $nextVideos = \Illuminate\Support\Facades\DB::table('materi')
                ->join('user', 'materi.id_guru', '=', 'user.id_user')
                ->where('materi.id_materi', '!=', $idMateri)
                ->where(function($q) use ($mapel) {
                    $q->where('materi.judul', 'LIKE', '%' . $mapel . '%')
                      ->orWhere('materi.mapel', 'LIKE', '%' . $mapel . '%');
                })
                ->select('materi.*', 'user.nama as nama_guru')
                ->limit(5)
                ->get();
        }
        
        return [
            'userName' => $userName,
            'mapel' => $mapel,
            'photoProfile' => $session->getPhotoProfile(),
            'materiData' => $materiData,
            'nextVideos' => $nextVideos
        ];
    }
}
