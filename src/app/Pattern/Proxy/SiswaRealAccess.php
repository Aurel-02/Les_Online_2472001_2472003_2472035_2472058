<?php

namespace App\Pattern\Proxy;

use App\Models\User;
use App\Models\ExamScore;
use Illuminate\Support\Facades\DB;

class SiswaRealAccess implements SiswaAccessInterface
{
    protected $siswaId;

    public function __construct($siswaId)
    {
        $this->siswaId = $siswaId;
    }

    public function getSiswa()
    {
        return User::where('role', 'siswa')
            ->where('id_user', $this->siswaId)
            ->first();
    }

    public function getExamHistories()
    {
        $siswa = $this->getSiswa();
        if (!$siswa) {
            return collect();
        }

        return ExamScore::where('user_id', $siswa->getKey())
            ->orderBy('created_at', 'desc')
            ->take(15)
            ->get();
    }

    public function getActivePackageInfo()
    {
        $siswa = $this->getSiswa();
        $activePackageName = null;
        $sisaHari = 0;

        if (!$siswa) {
            return compact('sisaHari', 'activePackageName');
        }

        $latestTransaction = DB::table('transaksi')
            ->join('paket_pembelajaran', 'transaksi.id_paket', '=', 'paket_pembelajaran.id_paket')
            ->where('transaksi.id_user', $siswa->id_user)
            ->where('transaksi.status', 'berhasil')
            ->orderBy('transaksi.id_transaksi', 'desc')
            ->first();

        if ($latestTransaction) {
            $createdAt = new \DateTime($latestTransaction->created_at);
            $now = new \DateTime();
            
            $createdTimestamp = $createdAt->getTimestamp();
            $nowTimestamp = $now->getTimestamp();
            $secondsActive = (int)$latestTransaction->masa_aktif * 24 * 3600;

            if ($nowTimestamp < ($createdTimestamp + $secondsActive)) {
                $remainingSeconds = ($createdTimestamp + $secondsActive) - $nowTimestamp;
                $sisaHari = (int)ceil($remainingSeconds / (24 * 3600));
                $activePackageName = $latestTransaction->nama;
            }
        }

        return compact('sisaHari', 'activePackageName');
    }
}
