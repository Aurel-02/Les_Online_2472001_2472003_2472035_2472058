<?php

namespace App\Pattern\Proxy;

use Illuminate\Support\Facades\DB;

class OrangTuaSiswaProxy implements SiswaAccessInterface
{
    protected $orangTuaId;
    protected $siswaId;
    protected $realAccess;

    public function __construct($orangTuaId, $siswaId)
    {
        $this->orangTuaId = $orangTuaId;
        $this->siswaId = $siswaId;
        $this->realAccess = new SiswaRealAccess($siswaId);
    }

    /**
     * Cek apakah siswaId ini benar anak dari orangTuaId
     */
    private function hasAccess()
    {
        if (!$this->siswaId) {
            return false;
        }

        return DB::table('ortu_siswa')
            ->where('id_orangtua', $this->orangTuaId)
            ->where('id_siswa', $this->siswaId)
            ->exists();
    }

    public function getSiswa()
    {
        if ($this->hasAccess()) {
            return $this->realAccess->getSiswa();
        }
        return null; // Deny access
    }

    public function getExamHistories()
    {
        if ($this->hasAccess()) {
            return $this->realAccess->getExamHistories();
        }
        return collect(); // Return empty if denied
    }

    public function getActivePackageInfo()
    {
        if ($this->hasAccess()) {
            return $this->realAccess->getActivePackageInfo();
        }
        return ['sisaHari' => 0, 'activePackageName' => null];
    }
}
