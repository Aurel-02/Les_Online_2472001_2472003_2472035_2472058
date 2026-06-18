<?php

namespace App\Pattern\DAO;

use App\Models\Materi;

class MateriDAO
{
    public function getTotalKelas(): int
    {
        return Materi::whereNotNull('kelas')->where('kelas', '!=', '')->distinct('kelas')->count('kelas');
    }
}
