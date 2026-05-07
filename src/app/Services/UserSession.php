<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

/**
 * ============================================================
 * SINGLETON PATTERN — UserSession
 * ============================================================
 * Kelas ini mengimplementasikan Singleton Pattern untuk
 * memastikan hanya ada SATU instance UserSession yang dibuat
 * selama siklus hidup request. Ini berguna agar data sesi
 * pengguna (login/logout/role) dikelola secara terpusat
 * dan konsisten di seluruh aplikasi.
 * ============================================================
 */
class UserSession
{
    // ─── SINGLETON: Static property menyimpan satu-satunya instance ───
    private static ?UserSession $instance = null;

    /**
     * SINGLETON: Constructor dibuat private agar kelas ini
     * tidak bisa di-instansiasi langsung dari luar dengan "new UserSession()".
     * Akses hanya melalui getInstance().
     */
    private function __construct()
    {
        // Private constructor — mencegah pembuatan instance dari luar
    }

    /**
     * SINGLETON: Metode statis untuk mendapatkan satu-satunya instance.
     * Jika instance belum ada, buat baru. Jika sudah ada, kembalikan yang lama.
     * Inilah inti dari Singleton Pattern.
     *
     * @return static
     */
    public static function getInstance(): static
    {
        // ─── SINGLETON: Cek apakah instance sudah ada ───
        if (static::$instance === null) {
            // Belum ada → buat instance baru (hanya sekali seumur hidup request)
            static::$instance = new static();
        }

        // Kembalikan instance yang sama setiap kali dipanggil
        return static::$instance;
    }

    /**
     * SINGLETON: Mencegah cloning instance.
     * Jika objek di-clone, akan ada lebih dari satu instance (melanggar Singleton).
     */
    public function __clone()
    {
        throw new \Exception('Cloning UserSession tidak diperbolehkan (Singleton Pattern).');
    }

    /**
     * SINGLETON: Mencegah unserialize instance.
     * Unserialize bisa membuat instance baru dari string — harus dicegah.
     */
    public function __wakeup()
    {
        throw new \Exception('Unserialize UserSession tidak diperbolehkan (Singleton Pattern).');
    }

    // ─────────────────────────────────────────────────────────────────
    // Metode-metode pengelolaan sesi pengguna (logika bisnis)
    // ─────────────────────────────────────────────────────────────────

    /**
     * Mendapatkan pengguna yang sedang login.
     * Menggunakan facade Auth bawaan Laravel.
     */
    public function getUser()
    {
        return Auth::user();
    }

    /**
     * Mengecek apakah ada pengguna yang sedang login.
     */
    public function isLoggedIn(): bool
    {
        return Auth::check();
    }

    /**
     * Mendapatkan role pengguna yang sedang login.
     * Mengembalikan null jika tidak ada yang login.
     */
    public function getRole(): ?string
    {
        $user = $this->getUser();
        return $user ? $user->role : null;
    }

    /**
     * Mendapatkan nama pengguna yang sedang login.
     */
    public function getName(): ?string
    {
        $user = $this->getUser();
        return $user ? $user->nama : null;
    }

    /**
     * Mendapatkan email pengguna yang sedang login.
     */
    public function getEmail(): ?string
    {
        $user = $this->getUser();
        return $user ? $user->email : null;
    }

    /**
     * Mengecek apakah pengguna yang login adalah 'siswa'.
     */
    public function isSiswa(): bool
    {
        return $this->getRole() === 'siswa';
    }

    /**
     * Mengecek apakah pengguna yang login adalah 'guru'.
     */
    public function isGuru(): bool
    {
        return $this->getRole() === 'guru';
    }

    /**
     * Mengecek apakah pengguna yang login adalah 'admin'.
     */
    public function isAdmin(): bool
    {
        return $this->getRole() === 'admin';
    }

    /**
     * Mengecek apakah pengguna yang login adalah 'orang tua'.
     */
    public function isOrangTua(): bool
    {
        return $this->getRole() === 'orang tua';
    }

    /**
     * Mendapatkan URL redirect yang sesuai berdasarkan role pengguna.
     * Digunakan setelah proses login berhasil.
     */
    public function getRedirectUrlByRole(): string
    {
        return match ($this->getRole()) {
            'siswa'     => '/siswa/home',
            'guru'      => '/guru/home',
            'admin'     => '/admin/dashboard',
            'orang tua' => '/orangtua/home',
            default     => '/',
        };
    }
}
