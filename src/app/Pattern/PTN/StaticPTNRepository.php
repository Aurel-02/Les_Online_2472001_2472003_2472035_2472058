<?php

namespace App\Pattern\PTN;

class StaticPTNRepository implements PTNRepositoryInterface
{
    private array $ptnData = [];
    private array $fakultasData = [];

    public function __construct()
    {
        $this->fakultasData = FakultasData::get();
    }

    public function getAllPTN(): array
    {
        try {
            $universities = \Illuminate\Support\Facades\DB::table('university')->get();
            $extMap  = PtnExtendedData::getMap();
            $imgMap  = PtnExtendedData::getImgMap();
            $result  = [];

            foreach ($universities as $univ) {
                preg_match('/\((.*?)\)/', $univ->nama_ptn, $m);
                $abbr = strtoupper($m[1] ?? '');
                $ext  = $extMap[$abbr] ?? null;

                if ($ext) {
                    $wilayah = $ext['wilayah'];
                    $fokus = $ext['fokus'];
                    $akreditasi = $ext['akreditasi'];
                    $mahasiswa = $ext['mahasiswa'];
                    $prodi = $ext['prodi'];
                    $jalur = $ext['jalur'];
                    $info = $ext['info'];
                    $fakultas = $ext['fakultas'];

                    $img = $imgMap[$abbr] ?? (file_exists(public_path('images/ptn/'.strtolower($abbr).'.png'))
                        ? '/images/ptn/'.strtolower($abbr).'.png' : null);
                    $result[] = [
                        'name'=>$univ->nama_ptn,'abbr'=>$abbr,'kota'=>$univ->lokasi,
                        'img'=>$img,'wilayah'=>$wilayah,'fokus'=>$fokus,
                        'akreditasi'=>$akreditasi,'mahasiswa'=>$mahasiswa,'prodi'=>$prodi,
                        'tags'=>array_merge([$akreditasi==='Unggul'?'Unggul':null],$wilayah==='jawa'?[]:[], ['SNBP','SNBT','Mandiri']),
                        'jalur'=>$jalur,'info'=>$info,'fakultas'=>$fakultas,
                    ];
                } else {
                    $img = $abbr && file_exists(public_path('images/ptn/'.strtolower($abbr).'.png'))
                        ? '/images/ptn/'.strtolower($abbr).'.png' : null;
                    $result[] = [
                        'name'=>$univ->nama_ptn,'abbr'=>$abbr?:'PTN','kota'=>$univ->lokasi,
                        'img'=>$img,'wilayah'=>'luar','fokus'=>'umum',
                        'akreditasi'=>'Baik Sekali','mahasiswa'=>'10.000+','prodi'=>'50+',
                        'tags'=>['SNBP','SNBT','Mandiri'],'jalur'=>['SNBP','SNBT','Mandiri'],
                        'info'=>'PTN di '.$univ->lokasi.' yang menawarkan berbagai program studi berkualitas.',
                        'fakultas'=>[['n'=>'Semua Fakultas','p'=>'Program Studi Pilihan','utbk'=>'550-650']],
                    ];
                }
            }
            return $result;
        } catch (\Exception $e) {
            return $this->ptnData;
        }
    }

    public function getAllFakultas(): array
    {
        return $this->fakultasData;
    }

    public function getFakultas(string $nama): ?array
    {
        return $this->fakultasData[$nama] ?? null;
    }

    public function getJurusanDetail(string $nama): ?array
    {
        // We will search for the specific prodi across all fakultas
        foreach ($this->fakultasData as $fakultasName => $fakultas) {
            foreach ($fakultas['prodi'] as $prodi) {
                if (strtolower($prodi['n']) === strtolower($nama)) {
                    // Enrich the data for the detail page
                    return [
                        'nama' => $prodi['n'],
                        'fakultas' => $fakultasName,
                        'icon' => $prodi['i'] ?? '🎓',
                        'color_class' => $prodi['c'] ?? 'bg-blue',
                        'singkat' => $prodi['d'],
                        'utbk' => $prodi['utbk'],
                        'gelar' => $fakultas['gelar'],
                        'durasi' => $fakultas['durasi'],
                        'akreditasi' => $fakultas['akreditasi'],
                        'desc' => "Jurusan " . $prodi['n'] . " merupakan bagian dari Fakultas " . $fakultasName . ". Program studi ini berfokus pada " . lcfirst($prodi['d']) . ". Mahasiswa akan dibekali dengan pengetahuan teoretis dan keterampilan praktis yang relevan dengan kebutuhan industri saat ini, sehingga siap bersaing di dunia kerja.",
                        'mata_kuliah' => [
                            "Pengantar " . $prodi['n'],
                            "Metodologi Penelitian",
                            "Praktikum Terapan",
                            "Kapita Selekta",
                            "Etika Profesi",
                            "Tugas Akhir / Skripsi"
                        ],
                        'prospek' => $fakultas['prospek'],
                    ];
                }
            }
        }
        
        // Default fallback if a specific Jurusan is passed but not found in the array
        return [
            'nama' => $nama,
            'fakultas' => 'Umum',
            'icon' => '🎓',
            'color_class' => 'bg-sage',
            'singkat' => 'Program studi pilihan',
            'utbk' => '600-700',
            'gelar' => 'S1',
            'durasi' => '4 Tahun',
            'akreditasi' => 'B/A',
            'desc' => "Jurusan " . $nama . " adalah program studi yang membekali mahasiswa dengan keahlian spesifik di bidangnya. Lulusan diharapkan mampu berkontribusi secara nyata di masyarakat dan dunia kerja profesional.",
            'mata_kuliah' => ["Mata Kuliah Dasar Umum", "Pengantar Keilmuan", "Praktek Lapangan", "Skripsi"],
            'prospek' => ["Profesional di bidangnya", "Peneliti", "Wirausahawan", "Akademisi"]
        ];
    }


}
