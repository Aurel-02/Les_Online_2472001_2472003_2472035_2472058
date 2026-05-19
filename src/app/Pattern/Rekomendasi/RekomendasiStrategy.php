<?php

namespace App\Pattern\Rekomendasi;

use App\Models\User;

interface RekomendasiStrategy
{
    /**
     * Hitung skor dan berikan rekomendasi jurusan.
     *
     * @param User $user
     * @return array
     */
    public function getRekomendasi(User $user): array;
}
