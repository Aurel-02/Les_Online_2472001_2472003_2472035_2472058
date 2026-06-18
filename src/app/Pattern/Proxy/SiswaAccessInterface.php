<?php

namespace App\Pattern\Proxy;

interface SiswaAccessInterface
{
    /**
     * Get the Siswa User model
     *
     * @return \App\Models\User|null
     */
    public function getSiswa();

    /**
     * Get exam histories for the Siswa
     *
     * @return \Illuminate\Support\Collection
     */
    public function getExamHistories();

    /**
     * Get the active package remaining days and name
     *
     * @return array ['sisaHari' => int, 'activePackageName' => string|null]
     */
    public function getActivePackageInfo();
}
