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

    public function users()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $users = \App\Models\User::where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.users', compact('userName', 'photoProfile', 'users'));
    }

    public function destroyUser($id)
    {
        $user = \App\Models\User::findOrFail($id);
        
        // Prevent deleting oneself
        if ($user->id_user === \Illuminate\Support\Facades\Auth::id()) {
            return redirect()->back()->with('error', 'Tidak dapat menonaktifkan akun sendiri.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Pengguna berhasil dinonaktifkan.');
    }
}
