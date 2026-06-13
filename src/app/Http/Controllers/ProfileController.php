<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserSession;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();

        return view('siswa.profile', [
            'userName' => $user->nama,
            'userEmail' => $user->email,
            'userRole' => $user->role,
            'userJenjang' => $user->id_jenjang,
            'photoProfile' => $user->photo_profile
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user = Auth::user();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan ke direktori public/uploads/profiles
            $file->move(public_path('uploads/profiles'), $filename);

            if ($user->photo_profile && file_exists(public_path('uploads/profiles/' . $user->photo_profile))) {
                unlink(public_path('uploads/profiles/' . $user->photo_profile));
            }

            $user->photo_profile = $filename;
            $user->save();

            return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah foto profil.');
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|unique:user,email,' . $user->id_user . ',id_user',
            'id_jenjang' => 'nullable|integer'
        ]);

        $user->email = $request->email;
        if ($request->has('id_jenjang')) {
            $user->id_jenjang = $request->id_jenjang;
        }
        $user->save();

        return redirect()->back()->with('success_profile', 'Perubahan berhasil disimpan!');
    }

    public function showChangePasswordForm()
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();

        return view('siswa.change_password', [
            'userName' => $user->nama,
            'photoProfile' => $user->photo_profile
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('siswa.profile')->with('success_password', 'Password berhasil diubah!');
    }

    public function indexGuru()
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();

        return view('guru.profile', [
            'userName' => $user->nama,
            'userEmail' => $user->email,
            'userRole' => $user->role,
            'photoProfile' => $user->photo_profile
        ]);
    }

    public function showChangePasswordFormGuru()
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();

        return view('guru.change_password', [
            'userName' => $user->nama,
            'photoProfile' => $user->photo_profile
        ]);
    }

    public function updatePasswordGuru(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('guru.profile')->with('success_password', 'Password berhasil diubah!');
    }

    public function indexOrangTua()
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();

        return view('orangtua.profile', [
            'userName' => $user->nama,
            'userEmail' => $user->email,
            'userRole' => $user->role,
            'userJenjang' => $user->id_jenjang,
            'photoProfile' => $user->photo_profile
        ]);
    }

    public function showChangePasswordFormOrangTua()
    {
        $session = UserSession::getInstance();
        $user = $session->getUser();

        return view('orangtua.change_password', [
            'userName' => $user->nama,
            'photoProfile' => $user->photo_profile
        ]);
    }

    public function updatePasswordOrangTua(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('orangtua.profile')->with('success_password', 'Password berhasil diubah!');
    }
    public function indexAdmin()
    {
        $session = UserSession::getInstance();
        $user = \Illuminate\Support\Facades\Auth::user();
        $userName = $user->nama;
        $userEmail = $user->email;
        $userRole = $user->role;
        $photoProfile = $user->photo_profile;

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();

        return view('admin.profile', compact('userName', 'userEmail', 'userRole', 'photoProfile', 'user', 'reactivationRequestsCount'));
    }

    public function changePasswordAdmin()
    {
        $session = UserSession::getInstance();
        $userName = $session->getName();
        $photoProfile = $session->getPhotoProfile();

        $reactivationRequestsCount = \App\Models\User::withTrashed()->where('reactivation_requested', true)->count();

        return view('admin.change_password', compact('userName', 'photoProfile', 'reactivationRequestsCount'));
    }

    public function updatePasswordAdmin(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();

        if (!\Illuminate\Support\Facades\Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak cocok']);
        }

        $user->password = \Illuminate\Support\Facades\Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.profile')->with('success_password', 'Password berhasil diubah!');
    }
}
