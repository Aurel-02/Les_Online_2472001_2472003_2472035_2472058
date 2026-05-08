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
        if (!$userName) {
            $userName = 'Siswa Pintar';
        }
        $mapel = request()->query('mapel', 'Matematika');
        
        return [
            'userName' => $userName,
            'mapel' => $mapel
        ];
    }
}
