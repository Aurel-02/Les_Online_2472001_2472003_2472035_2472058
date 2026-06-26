<?php

namespace App\Pattern\DAO;

use App\Models\Pengumuman;

class PengumumanDAO
{
    public function getAllPengumuman()
    {
        return Pengumuman::orderBy('id_pengumuman', 'desc')->get();
    }

    public function createPengumuman(array $data)
    {
        return Pengumuman::create($data);
    }

    public function deletePengumuman($id)
    {
        return Pengumuman::findOrFail($id)->delete();
    }

    public function toggleAktif($id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        $pengumuman->aktif = !$pengumuman->aktif;
        $pengumuman->save();
        return $pengumuman;
    }

    /**
     * Get active pengumuman for a specific role.
     * Returns pengumuman where target is 'semua' or matches the given role.
     */
    public function getActivePengumumanForRole(string $role)
    {
        return Pengumuman::where('aktif', true)
            ->where(function ($query) use ($role) {
                $query->where('target', 'semua')
                      ->orWhere('target', $role);
            })
            ->orderBy('created_at', 'desc')
            ->get();
    }
}
