<?php

namespace App\Pattern\DAO;

use App\Models\PaketPembelajaran;

class PaketPembelajaranDAO
{
    public function getAllPakets()
    {
        return PaketPembelajaran::orderBy('id_paket', 'desc')->get();
    }

    public function getPaketsByJenjang($jenjangName)
    {
        if ($jenjangName) {
            return PaketPembelajaran::where('jenjang', $jenjangName)
                ->orWhere('jenjang', 'Umum')
                ->get();
        }
        return $this->getAllPakets();
    }

    public function createPaket(array $data)
    {
        return PaketPembelajaran::create($data);
    }

    public function updatePaket($id, array $data)
    {
        $paket = PaketPembelajaran::findOrFail($id);
        $paket->update($data);
        return $paket;
    }

    public function deletePaket($id)
    {
        $paket = PaketPembelajaran::findOrFail($id);
        return $paket->delete();
    }
}
