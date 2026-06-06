<?php

namespace App\Pattern\Catatan;

use App\Pattern\MateriInterface;
use App\Services\UserSession;

class CatatanMateri implements MateriInterface
{
    public function getView(): string
    {
        return 'siswa.catatan';
    }

    public function getData(): array
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $user = $session->getUser();
        if (!$userName) {
            $userName = 'Siswa Pintar';
        }
        $mapel = request()->query('mapel', 'Matematika');
        
        $catatans = [];
        if ($user) {
            $catatans = \App\Models\Catatan::where('id_user', $user->getKey())
                        ->orderBy('updated_at', 'desc')
                        ->get();
        }
        
        return [
            'userName' => $userName,
            'mapel' => $mapel,
            'photoProfile' => $session->getPhotoProfile(),
            'catatans' => $catatans
        ];
    }
}
