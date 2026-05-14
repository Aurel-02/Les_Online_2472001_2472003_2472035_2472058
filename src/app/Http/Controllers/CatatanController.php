<?php

namespace App\Http\Controllers;

use App\Pattern\MateriFactory;
use App\Services\UserSession;
use App\Models\Activity;
use Illuminate\Http\Request;

class CatatanController extends Controller
{
    public function index()
    {
        $session = UserSession::getInstance();
        $user    = $session->getUser();

        if ($user) {
            Activity::create([
                'user_id'     => $user->getKey(),
                'type'        => 'catatan',
                'description' => 'Membaca dan membuat catatan materi',
            ]);
        }

        $materi = MateriFactory::create('catatan');
        return view($materi->getView(), $materi->getData());
    }
}
