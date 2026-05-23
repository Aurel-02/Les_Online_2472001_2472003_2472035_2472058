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
        $jenjangs = \Illuminate\Support\Facades\DB::table('jenjang')->get();
        return view('auth.register', compact('jenjangs'));
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
            'email'    => 'required|string|email|max:255|unique:user,email',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:admin,orang tua,siswa,guru',
            'id_jenjang' => 'required_if:role,siswa',
        ]);

        try {
            $user = User::create([
                'nama'     => $request->name,
                'email'    => $request->email,
                'password' => Hash::make($request->password), // Make sure password is hashed
                'role'     => $request->role,
                'id_jenjang' => $request->role === 'siswa' ? $request->id_jenjang : null,
            ]);
        } catch (\Throwable $e) {
            dd('Registration Error:', $e->getMessage(), $e->getLine(), $e->getFile(), $e->getTraceAsString());
        }

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
