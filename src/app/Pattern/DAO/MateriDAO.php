<?php

namespace App\Pattern\DAO;

use App\Models\Materi;

class MateriDAO
{
    public function getTotalKelas(): int
    {
        return Materi::whereNotNull('kelas')->where('kelas', '!=', '')->distinct('kelas')->count('kelas');
    }

    public function searchMateriWithGuruByJudul($judul)
    {
        return \Illuminate\Support\Facades\DB::table('materi')
            ->join('user', 'materi.id_guru', '=', 'user.id_user')
            ->where('materi.judul', 'LIKE', '%' . $judul . '%')
            ->select('materi.*', 'user.nama as nama_guru')
            ->get();
    }
}
