<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSession;

class AdminController extends Controller
{
    public function dashboard()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        return view('admin.dashboard', compact('userName', 'photoProfile'));
    }
}
