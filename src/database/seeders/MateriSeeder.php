<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('materi')->truncate();
        $gurus = DB::table('user')->where('role', 'guru')->pluck('id_user')->toArray();
        if (empty($gurus)) {
            $gurus = [6, 7, 8, 9, 10]; // Fallback if no gurus
        }

        $materis = [
            ['judul' => 'Matematika - Persamaan Kuadrat', 'deskripsi' => 'Video Matematika', 'link_video' => 'https://www.youtube.com/embed/AIS6lYgI1As', 'jenjang' => 'SMA', 'id_guru' => $gurus[0 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Matematika Wajib - Trigonometri', 'deskripsi' => 'Video Matematika Wajib', 'link_video' => 'https://www.youtube.com/embed/LS949g6wkKQ', 'jenjang' => 'SMA', 'id_guru' => $gurus[0 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Fisika - Besaran dan Satuan', 'deskripsi' => 'Video Fisika', 'link_video' => 'https://www.youtube.com/embed/4J95ZYD387o', 'jenjang' => 'SMA', 'id_guru' => $gurus[1 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Fisika - Hukum Newton', 'deskripsi' => 'Video Fisika Hukum Newton', 'link_video' => 'https://www.youtube.com/embed/QV45_JDRZ_c', 'jenjang' => 'SMA', 'id_guru' => $gurus[1 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Kimia - Struktur Atom', 'deskripsi' => 'Video Kimia', 'link_video' => 'https://www.youtube.com/embed/3nsOlPrpdsA', 'jenjang' => 'SMA', 'id_guru' => $gurus[2 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Kimia - Ikatan Kimia', 'deskripsi' => 'Video Kimia Ikatan', 'link_video' => 'https://www.youtube.com/embed/oD0tDw7B0eU', 'jenjang' => 'SMA', 'id_guru' => $gurus[2 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Biologi - Sel dan Strukturnya', 'deskripsi' => 'Video Biologi', 'link_video' => 'https://www.youtube.com/embed/6_GpcjuFTfE', 'jenjang' => 'SMA', 'id_guru' => $gurus[3 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Biologi - Genetika', 'deskripsi' => 'Video Biologi Genetika', 'link_video' => 'https://www.youtube.com/embed/-1iU8EKV6iY', 'jenjang' => 'SMA', 'id_guru' => $gurus[3 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Sejarah - Proklamasi Kemerdekaan', 'deskripsi' => 'Video Sejarah', 'link_video' => 'https://www.youtube.com/embed/nM4mitSBQKk', 'jenjang' => 'SMA', 'id_guru' => $gurus[4 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Bahasa Indonesia - Teks Laporan Hasil Observasi', 'deskripsi' => 'Video Bahasa Indonesia', 'link_video' => 'https://www.youtube.com/embed/wKfPJdjiauw', 'jenjang' => 'SMA', 'id_guru' => $gurus[0 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Bahasa Inggris - Tenses', 'deskripsi' => 'Video Bahasa Inggris', 'link_video' => 'https://www.youtube.com/embed/B2IldXHBDA0', 'jenjang' => 'SMA', 'id_guru' => $gurus[1 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Ekonomi - Kebijakan Moneter', 'deskripsi' => 'Video Ekonomi', 'link_video' => 'https://www.youtube.com/embed/kPW_fq-mCt4', 'jenjang' => 'SMA', 'id_guru' => $gurus[2 % count($gurus)], 'created_at' => now(), 'updated_at' => now()],
            ['judul' => 'Ekonomi - Pendapatan Nasional', 'deskripsi' => 'Video Ekonomi', 'link_video' => 'https://www.youtube.com/embed/q34Ml8no9gc', 'jenjang' => 'SMA', 'id_guru' => $gurus[2 % count($gurus)], 'created_at' => now(), 'updated_at' => now()]
        ];

        DB::table('materi')->insert($materis);
    }
}
