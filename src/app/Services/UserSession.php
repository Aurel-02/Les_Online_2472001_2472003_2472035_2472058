<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserSession
{
    private static ?UserSession $instance = null;

    private function __construct()
    {
    }

    /**
     *
     * @return static
     */
    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    public function __clone()
    {
        throw new \Exception('Cloning UserSession tidak diperbolehkan (Singleton Pattern).');
    }

    public function __wakeup()
    {
        throw new \Exception('Unserialize UserSession tidak diperbolehkan (Singleton Pattern).');
    }

    public function getUser()
    {
        return Auth::user();
    }

    public function isLoggedIn(): bool
    {
        return Auth::check();
    }

    public function getRole(): ?string
    {
        $user = $this->getUser();
        return $user ? $user->role : null;
    }

    public function getName(): ?string
    {
        $user = $this->getUser();
        return $user ? $user->nama : null;
    }

    public function getEmail(): ?string
    {
        $user = $this->getUser();
        return $user ? $user->email : null;
    }

    public function getPhotoProfile(): ?string
    {
        $user = $this->getUser();
        return $user ? $user->photo_profile : null;
    }

    public function isSiswa(): bool
    {
        return $this->getRole() === 'siswa';
    }

    public function isGuru(): bool
    {
        return $this->getRole() === 'guru';
    }

    public function isAdmin(): bool
    {
        return $this->getRole() === 'admin';
    }

    public function isOrangTua(): bool
    {
        return $this->getRole() === 'orang tua';
    }

    public function getRedirectUrlByRole(): string
    {
        return match ($this->getRole()) {
            'siswa'     => '/siswa/home',
            'guru'      => '/guru/dashboard',
            'admin'     => '/admin/dashboard',
            'orang tua' => '/orangtua/home',
            default     => '/',
        };
    }
}
