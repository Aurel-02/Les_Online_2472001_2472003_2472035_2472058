<?php

namespace App\Http\Controllers;

use App\Pattern\MateriFactory;
use App\Services\UserSession;
use App\Models\Activity;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $session = UserSession::getInstance();
        $user    = $session->getUser();

        if ($user) {
            Activity::create([
                'user_id'     => $user->getKey(),
                'type'        => 'materi',
                'description' => 'Menonton video materi pembelajaran',
            ]);
        }

        $materi = MateriFactory::create('video');
        return view($materi->getView(), $materi->getData());
    }
}
