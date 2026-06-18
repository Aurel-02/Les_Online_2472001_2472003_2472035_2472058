<?php

namespace App\Pattern\DAO;

use App\Models\Materi;

class MateriDAO
{
    public function getTotalKelas(): int
    {
        return Materi::whereNotNull('kelas')->where('kelas', '!=', '')->distinct('kelas')->count('kelas');
    }

    public function searchMateriWithGuruByJudul($keyword, $kelas = null, $jurusan = null)
    {
        $query = \Illuminate\Support\Facades\DB::table('materi')
            ->join('user', 'materi.id_guru', '=', 'user.id_user')
            ->where(function($q) use ($keyword) {
                $q->where('materi.judul', 'LIKE', '%' . $keyword . '%')
                  ->orWhere('materi.mapel', 'LIKE', '%' . $keyword . '%');
            });

        if ($kelas) {
            $query->where('materi.kelas', (string)$kelas);
        }

        if ($jurusan) {
            $query->where(function($q) use ($jurusan) {
                $q->where('materi.jurusan', $jurusan)
                  ->orWhereNull('materi.jurusan')
                  ->orWhere('materi.jurusan', '')
                  ->orWhere('materi.jurusan', 'Semua Jurusan')
                  ->orWhere('materi.jurusan', 'semua');
            });
        }

        return $query->select('materi.*', 'user.nama as nama_guru')->get();
    }
}
