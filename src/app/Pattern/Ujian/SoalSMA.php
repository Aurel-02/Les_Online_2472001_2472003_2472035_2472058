<?php

namespace App\Pattern\Ujian;

class SoalSMA implements SoalUjianInterface
{
    private int $count        = 10;
    private int $utbkCount    = 15;

    public function getQuestions(string $jenis, string $mapel): array
    {
        if ($jenis === 'tryout') {
            return $this->getSNBTQuestions();
        }
        return $this->getGeneralQuestions();
    }

    private function getGeneralQuestions(): array
    {
        $questions = [];
        for ($i = 1; $i <= $this->count; $i++) {
            $a       = rand(1, 6);
            $b       = rand(1, 10);
            $c       = rand(0, 8);
            $da      = 2 * $a;
            $correct = "{$da}x + {$b}";
            $text    = "Turunan pertama dari f(x) = {$a}x² + {$b}x + {$c} adalah?";
            $explanation = "Aturan turunan pangkat: d/dx(ax^n) = n·ax^(n-1). Untuk {$a}x² → 2·{$a}x = {$da}x. Untuk {$b}x → {$b}. Konstanta {$c} hilang. Jadi f'(x) = {$da}x + {$b}.";

            $opts = [
                'A' => "{$a}x + {$b}",
                'B' => "{$da}x + {$c}",
                'C' => $correct,
                'D' => "{$a}x² + {$b}",
            ];

            $questions[] = [
                'id'          => $i,
                'text'        => "Soal No. {$i}: " . $text,
                'options'     => $opts,
                'correct'     => 'C',
                'explanation' => $explanation,
            ];
        }
        return $questions;
    }

    private function getSNBTQuestions(): array
    {
        $questions = [];
        $pool      = $this->buildSNBTPool();

        // Ambil 15 soal acak dari pool
        $indices = array_rand($pool, min($this->utbkCount, count($pool)));
        if (!is_array($indices)) $indices = [$indices];

        foreach ($indices as $rank => $idx) {
            $q               = $pool[$idx];
            $q['id']         = $rank + 1;
            $q['text']       = "Soal No. " . ($rank + 1) . " [{$q['tag']}]: " . $q['text'];
            unset($q['tag']);
            $questions[]     = $q;
        }

        return $questions;
    }

    /** Pool besar soal UTBK-style */
    private function buildSNBTPool(): array
    {
        $pool = [];

        /* ── Tipe 1: Penalaran Umum – Deret Angka ── */
        for ($i = 0; $i < 6; $i++) {
            $a  = rand(2, 15);
            $d  = rand(2, 10);
            $s  = [$a, $a+$d, $a+2*$d, $a+3*$d];
            $ans = $a + 4 * $d;
            $decoys = $this->generateDecoys($ans, 3);
            $opts   = [$decoys[0], $decoys[1], $ans, $decoys[2]];
            $pool[] = [
                'tag'  => 'Penalaran Umum',
                'text' => "Perhatikan barisan angka: {$s[0]}, {$s[1]}, {$s[2]}, {$s[3]}, … Berapakah angka selanjutnya?",
                'options' => ['A' => (string)$opts[0], 'B' => (string)$opts[1], 'C' => (string)$ans, 'D' => (string)$opts[3]],
                'correct' => 'C',
                'explanation' => "Barisan aritmetika dengan beda d={$d}. Suku ke-5 = {$a} + 4×{$d} = {$ans}.",
            ];
        }

        /* ── Tipe 2: Penalaran Umum – Silogisme ── */
        $silogismes = [
            [
                'text' => "Semua mamalia berdarah panas. Semua paus adalah mamalia. Kesimpulan yang tepat adalah …",
                'options' => ['A' => 'Semua paus hidup di laut', 'B' => 'Semua paus berdarah panas', 'C' => 'Sebagian mamalia adalah paus', 'D' => 'Semua berdarah panas adalah paus'],
                'correct' => 'B',
                'explanation' => "Silogisme: P1: Semua mamalia berdarah panas. P2: Paus adalah mamalia. Kesimpulan: Paus berdarah panas.",
            ],
            [
                'text' => "Jika seseorang rajin belajar, maka ia akan sukses. Budi rajin belajar. Kesimpulan yang tepat adalah …",
                'options' => ['A' => 'Budi mungkin sukses', 'B' => 'Budi pasti gagal', 'C' => 'Budi pasti sukses', 'D' => 'Sukses tidak bergantung belajar'],
                'correct' => 'C',
                'explanation' => "Modus Ponens: P→Q, P ⊢ Q. Budi rajin belajar (P), maka Budi sukses (Q).",
            ],
            [
                'text' => "Semua dokter adalah sarjana. Rina bukan sarjana. Kesimpulan yang tepat adalah …",
                'options' => ['A' => 'Rina mungkin dokter', 'B' => 'Rina bukan dokter', 'C' => 'Dokter tidak harus sarjana', 'D' => 'Sarjana pasti dokter'],
                'correct' => 'B',
                'explanation' => "Modus Tollens: Semua dokter adalah sarjana. Rina bukan sarjana → Rina bukan dokter.",
            ],
        ];
        foreach ($silogismes as $s) {
            $s['tag'] = 'Penalaran Umum';
            $pool[]   = $s;
        }

        /* ── Tipe 3: Literasi Bahasa Indonesia – Pemahaman Teks ── */
        $literasiID = [
            [
                'text' => "Bacaan: \"Polusi udara di kota besar terus meningkat akibat emisi kendaraan bermotor. Pemerintah perlu mengambil langkah tegas seperti membatasi penggunaan kendaraan pribadi.\" Gagasan utama paragraf tersebut adalah …",
                'options' => ['A' => 'Kendaraan bermotor satu-satunya penyebab polusi', 'B' => 'Polusi udara meningkat dan butuh tindakan pemerintah', 'C' => 'Pembatasan kendaraan sudah dilakukan', 'D' => 'Polusi hanya ada di kota besar'],
                'correct' => 'B',
                'explanation' => "Gagasan utama mencakup masalah (polusi meningkat) dan solusi (pemerintah perlu bertindak).",
            ],
            [
                'text' => "\"Membaca adalah jendela dunia.\" Makna ungkapan tersebut adalah …",
                'options' => ['A' => 'Membaca harus di dekat jendela', 'B' => 'Dunia terbuat dari buku', 'C' => 'Membaca membuka wawasan tentang dunia', 'D' => 'Jendela lebih baik dari buku'],
                'correct' => 'C',
                'explanation' => "Ungkapan ini bermakna membaca memberikan pengetahuan luas tentang dunia.",
            ],
            [
                'text' => "Kata \"konkret\" dalam kalimat \"Diperlukan langkah konkret untuk mengatasi kemiskinan\" bermakna …",
                'options' => ['A' => 'Abstrak dan tidak jelas', 'B' => 'Nyata dan dapat dilaksanakan', 'C' => 'Teoritis dan akademis', 'D' => 'Simbolis dan representatif'],
                'correct' => 'B',
                'explanation' => "'Konkret' berarti nyata, berwujud, dan bisa dilaksanakan secara langsung.",
            ],
        ];
        foreach ($literasiID as $l) {
            $l['tag'] = 'Literasi Bahasa Indonesia';
            $pool[]   = $l;
        }

        /* ── Tipe 4: Pengetahuan Kuantitatif – Aljabar & Perbandingan ── */
        for ($i = 0; $i < 5; $i++) {
            $p = rand(2, 8);
            $q = rand(2, 5);
            $r = $p * $q;
            $ans = $r;
            $decoys = $this->generateDecoys($ans, 3);
            $pool[] = [
                'tag'  => 'Pengetahuan Kuantitatif',
                'text' => "Harga {$p} buku adalah Rp {$r}.000. Harga {$q} buku yang sama adalah …",
                'options' => [
                    'A' => "Rp " . ($ans - $decoys[0] + $ans) . ".000",
                    'B' => "Rp " . ($p + $q) . ".000",
                    'C' => "Rp " . ($ans) . ".000",
                    'D' => "Rp " . ($q * ($p + 1)) . ".000",
                ],
                'correct' => 'C',
                'explanation' => "Harga 1 buku = Rp {$r}.000 ÷ {$p} = Rp " . ($r/$p) . ".000. Harga {$q} buku = {$q} × Rp " . ($r/$p) . ".000 = Rp {$ans}.000.",
            ];
        }

        /* ── Tipe 5: Literasi Bahasa Inggris ── */
        $literasiEN = [
            [
                'text' => "Read: \"Despite the heavy rain, the students continued their outdoor activities.\" The word 'despite' is closest in meaning to …",
                'options' => ['A' => 'Because of', 'B' => 'In spite of', 'C' => 'As a result of', 'D' => 'Due to'],
                'correct' => 'B',
                'explanation' => "'Despite' = 'in spite of' — both express contrast/concession.",
            ],
            [
                'text' => "Choose the sentence with correct grammar: …",
                'options' => ['A' => 'She don\'t like coffee', 'B' => 'He doesn\'t likes coffee', 'C' => 'They doesn\'t like coffee', 'D' => 'She doesn\'t like coffee'],
                'correct' => 'D',
                'explanation' => "Subject 'she' (3rd person singular) uses 'doesn't' + bare infinitive: 'doesn't like'.",
            ],
            [
                'text' => "The word 'beneficial' in the sentence \"Regular exercise is beneficial to health\" means …",
                'options' => ['A' => 'Harmful', 'B' => 'Irrelevant', 'C' => 'Advantageous', 'D' => 'Compulsory'],
                'correct' => 'C',
                'explanation' => "'Beneficial' means advantageous / helpful / giving benefit.",
            ],
        ];
        foreach ($literasiEN as $e) {
            $e['tag'] = 'Literasi Bahasa Inggris';
            $pool[]   = $e;
        }

        return $pool;
    }

    private function generateDecoys(int $correct, int $count): array
    {
        $decoys = [];
        $used   = [$correct];
        while (count($decoys) < $count) {
            $offset    = rand(-8, 8);
            if ($offset === 0) $offset = 3;
            $candidate = $correct + $offset;
            if ($candidate > 0 && !in_array($candidate, $used)) {
                $decoys[] = $candidate;
                $used[]   = $candidate;
            }
        }
        return $decoys;
    }
}
