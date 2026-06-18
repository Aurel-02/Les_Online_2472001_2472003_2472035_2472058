<?php

namespace App\Pattern\DAO;

use App\Models\User;

class UserDAO
{
    public function getReactivationRequestsCount(): int
    {
        return User::withTrashed()->where('reactivation_requested', true)->count();
    }

    public function getTotalSiswa(): int
    {
        return User::where('role', 'siswa')->count();
    }

    public function getTotalGuru(): int
    {
        return User::where('role', 'guru')->count();
    }

    public function getUsersExcludingAdmin()
    {
        return User::withTrashed()
            ->where('role', '!=', 'admin')
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getReactivationRequests()
    {
        return User::withTrashed()
            ->where('reactivation_requested', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function findUserById($id)
    {
        return User::findOrFail($id);
    }

    public function findWithTrashedById($id)
    {
        return User::withTrashed()->findOrFail($id);
    }

    public function softDeleteUser($id)
    {
        $user = clone $this->findUserById($id);
        $context = new \App\Pattern\State\UserContext($user);
        $context->suspend();
        return $user;
    }

    public function restoreUser($id)
    {
        $user = clone $this->findWithTrashedById($id);
        $context = new \App\Pattern\State\UserContext($user);
        $context->activate();
        return $user;
    }
}
