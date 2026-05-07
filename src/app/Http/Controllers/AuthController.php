<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserSession; // ← SINGLETON: Import kelas UserSession
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // ─── SINGLETON: Ambil instance tunggal UserSession ───────────────
            // getInstance() memastikan hanya ada satu objek UserSession
            // yang digunakan di seluruh aplikasi (tidak ada "new UserSession()").
            $session = UserSession::getInstance();

            // ─── SINGLETON: Gunakan metode getRedirectUrlByRole() dari instance ───
            // Instance yang sama digunakan untuk membaca role dan menentukan
            // URL tujuan redirect setelah login berhasil.
            return redirect($session->getRedirectUrlByRole());
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,orang tua,siswa,guru',
        ]);

        $user = User::create([
            'nama'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
            'role'     => $request->role,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }

    public function logout(Request $request)
    {
        // ─── SINGLETON: Instance UserSession tetap dipakai sebelum logout ───
        // (opsional, bisa digunakan untuk logging aktivitas logout)
        $session = UserSession::getInstance();
        // Contoh: Log::info($session->getName() . ' telah logout.');

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
