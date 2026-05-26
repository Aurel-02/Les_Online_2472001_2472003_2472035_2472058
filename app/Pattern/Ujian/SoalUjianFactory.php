<?php

namespace App\Pattern\Ujian;

class SoalUjianFactory
{
    /**
     * Create the appropriate SoalUjian object based on the jenjang_id
     * 1: SD, 2: SMP, 3: SMA
     */
    public static function createSoalUjian(int $jenjangId): SoalUjianInterface
    {
        return match ($jenjangId) {
            1 => new SoalSD(),
            2 => new SoalSMP(),
            3 => new SoalSMA(),
            default => new SoalSMA(),
        };
    }
}
