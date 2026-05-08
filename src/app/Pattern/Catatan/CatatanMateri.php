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
        // Menarik nama siswa dari database via UserSession (yang mengambil dari Auth::user())
        $session = UserSession::getInstance();
        
        return [
            'userName' => $session->getName()
        ];
    }
}
