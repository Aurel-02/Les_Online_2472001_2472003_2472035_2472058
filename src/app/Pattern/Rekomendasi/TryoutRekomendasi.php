<?php

namespace App\Pattern\Rekomendasi;

use App\Models\User;
use App\Models\ExamScore;
use App\Pattern\PTN\PtnExtendedData;

class TryoutRekomendasi implements RekomendasiStrategy
{
    public function getRekomendasi(User $user): array
    {
        // 1. Ambil rata-rata utbk_raw_score
        $avgRaw = ExamScore::where('user_id', $user->id)
            ->where('jenis', 'tryout')
            ->avg('utbk_raw_score');

        if (is_null($avgRaw)) {
            return [
                'has_tryout' => false,
                'avg_raw'    => 0,
                'utbk_score' => 0,
                'rekomendasi'=> []
            ];
        }

        // Clamp minimum 0 untuk jaga-jaga (skor terendah -15 bisa terjadi)
        $avgRaw = max(0, $avgRaw);

        // 2. Normalisasi ke skala UTBK (Asumsi max raw 60 = 850)
        // Base 400, max tambah 450
        $utbkScore = 400 + ($avgRaw / 60) * 450;
        
        // Batasi maksimal 1000, walau secara logika max 850
        $utbkScore = min(1000, $utbkScore);

        // 3. Cari jurusan yang sesuai target_nilai
        $semuaProdi = [];
        $ptnMap = PtnExtendedData::getMap();

        foreach ($ptnMap as $namaPtn => $ptnData) {
            foreach ($ptnData['fakultas'] as $fakultas) {
                // Parsing rentang UTBK (contoh: '780-820')
                $utbkRange = explode('-', $fakultas['utbk']);
                $targetBawah = (int) $utbkRange[0];
                
                // Jika nilai mencukupi (bisa kita set toleransi misal -30 masih recommended)
                if ($utbkScore >= ($targetBawah - 30)) {
                    $semuaProdi[] = [
                        'ptn'      => $namaPtn,
                        'fakultas' => $fakultas['n'],
                        'prodi'    => $fakultas['p'],
                        'target'   => $fakultas['utbk'],
                        'selisih'  => $utbkScore - $targetBawah // Untuk sorting, makin tinggi selisih makin aman
                    ];
                }
            }
        }

        // Sortir dari yang selisihnya paling aman (paling tinggi)
        usort($semuaProdi, function($a, $b) {
            return $b['selisih'] <=> $a['selisih'];
        });

        // Ambil top 15 rekomendasi terbaik
        $rekomendasiList = array_slice($semuaProdi, 0, 15);

        return [
            'has_tryout' => true,
            'avg_raw'    => round($avgRaw, 1),
            'utbk_score' => round($utbkScore),
            'rekomendasi'=> $rekomendasiList
        ];
    }
}
