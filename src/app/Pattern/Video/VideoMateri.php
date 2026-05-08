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
        
        return [
            'userName' => $userName,
            'mapel' => $mapel,
            'photoProfile' => $session->getPhotoProfile()
        ];
    }
}
