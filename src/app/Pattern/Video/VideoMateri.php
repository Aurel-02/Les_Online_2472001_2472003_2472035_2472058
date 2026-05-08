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
        // Menarik nama siswa dari database via UserSession (yang mengambil dari Auth::user())
        $session = UserSession::getInstance();
        
        return [
            'userName' => $session->getName()
        ];
    }
}
