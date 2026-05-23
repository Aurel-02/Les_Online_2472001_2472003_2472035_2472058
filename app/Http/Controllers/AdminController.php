<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materi;
use App\Models\Transaksi;
use App\Services\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ─── Shared sidebar data helper ─────────────────────────────────────────────
    private function sidebarData(): array
    {
        $session = UserSession::getInstance();
        return [
            'userName'     => $session->getName(),
            'photoProfile' => $session->getPhotoProfile(),
        ];
    }

    // ─── DASHBOARD ──────────────────────────────────────────────────────────────
    public function dashboard()
    {
        $sd = $this->sidebarData();

        $totalSiswa   = User::where('role', 'siswa')->count();
        $totalTutor   = User::where('role', 'guru')->count();
        $kelasHariIni = Materi::count();

        $rawIncome  = Transaksi::where('status', 'berhasil')->sum('subtotal');
        if ($rawIncome == 0) $rawIncome = 12500000;
        $pendapatan = number_format($rawIncome, 0, ',', '.');

        $stats = [
            'total_siswa'   => $totalSiswa,
            'total_tutor'   => $totalTutor,
            'kelas_hari_ini' => $kelasHariIni > 0 ? $kelasHariIni : 8,
            'pendapatan'    => $pendapatan,
        ];

        $siswa_terbaru = User::where('role', 'siswa')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($user) {
                $kelasLabel = match ($user->id_jenjang) {
                    1 => 'SD',
                    2 => 'SMP',
                    3 => 'SMA',
                    default => 'SMA'
                };
                return [
                    'id_user' => $user->id_user,
                    'nama'    => $user->nama,
                    'kelas'   => $kelasLabel,
                    'status'  => ($user->id_user % 2 === 0) ? 'Aktif' : 'Pending',
                ];
            });

        return view('admin.dashboard', array_merge($sd, compact('stats', 'siswa_terbaru')));
    }

    // ─── CRUD PENGGUNA ──────────────────────────────────────────────────────────

    /**
     * Index — daftar semua user dengan filter role & search
     */
    public function penggunaIndex(Request $request)
    {
        $sd = $this->sidebarData();

        $query = User::query();

        // Filter by role
        $role = $request->query('role', '');
        if ($role && in_array($role, ['siswa', 'guru', 'admin', 'orang tua'])) {
            $query->where('role', $role);
        }

        // Search by name or email
        $search = $request->query('search', '');
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        // Counts per role for tab badges
        $roleCounts = [
            'semua'     => User::count(),
            'siswa'     => User::where('role', 'siswa')->count(),
            'guru'      => User::where('role', 'guru')->count(),
            'admin'     => User::where('role', 'admin')->count(),
            'orang tua' => User::where('role', 'orang tua')->count(),
        ];

        return view('admin.pengguna.index', array_merge($sd, compact('users', 'roleCounts', 'role', 'search')));
    }

    /**
     * Create — tampilkan form tambah user
     */
    public function penggunaCreate()
    {
        $sd = $this->sidebarData();
        return view('admin.pengguna.form', array_merge($sd, ['user' => null]));
    }

    /**
     * Store — simpan user baru
     */
    public function penggunaStore(Request $request)
    {
        $request->validate([
            'nama'       => 'required|string|max:100',
            'email'      => 'required|email|max:100|unique:user,email',
            'password'   => 'required|string|min:8|confirmed',
            'role'       => 'required|in:admin,guru,siswa,orang tua',
            'id_jenjang' => 'required_if:role,siswa|nullable|integer|in:1,2,3',
        ], [
            'email.unique'           => 'Email ini sudah digunakan oleh pengguna lain.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
            'id_jenjang.required_if' => 'Jenjang wajib dipilih untuk siswa.',
        ]);

        User::create([
            'nama'       => $request->nama,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
            'role'       => $request->role,
            'id_jenjang' => $request->role === 'siswa' ? $request->id_jenjang : null,
        ]);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna baru berhasil ditambahkan!');
    }

    /**
     * Edit — tampilkan form edit user
     */
    public function penggunaEdit($id)
    {
        $sd   = $this->sidebarData();
        $user = User::findOrFail($id);
        return view('admin.pengguna.form', array_merge($sd, compact('user')));
    }

    /**
     * Update — simpan perubahan user
     */
    public function penggunaUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama'       => 'required|string|max:100',
            'email'      => 'required|email|max:100|unique:user,email,' . $user->id_user . ',id_user',
            'password'   => 'nullable|string|min:8|confirmed',
            'role'       => 'required|in:admin,guru,siswa,orang tua',
            'id_jenjang' => 'required_if:role,siswa|nullable|integer|in:1,2,3',
        ], [
            'email.unique'           => 'Email ini sudah digunakan oleh pengguna lain.',
            'password.confirmed'     => 'Konfirmasi password tidak cocok.',
            'id_jenjang.required_if' => 'Jenjang wajib dipilih untuk siswa.',
        ]);

        $data = [
            'nama'       => $request->nama,
            'email'      => $request->email,
            'role'       => $request->role,
            'id_jenjang' => $request->role === 'siswa' ? $request->id_jenjang : null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Destroy — hapus user (tidak bisa hapus diri sendiri)
     */
    public function penggunaDestroy($id)
    {
        $session     = UserSession::getInstance();
        $currentUser = $session->getUser();

        if ($currentUser && $currentUser->id_user == $id) {
            return redirect()->route('admin.pengguna.index')
                ->with('error', 'Anda tidak dapat menghapus akun Anda sendiri!');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil dihapus.');
    }
}
