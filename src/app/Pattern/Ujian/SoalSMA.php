<?php

namespace App\Pattern\Ujian;

class SoalSMA implements SoalUjianInterface
{
    private int $count = 10;

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
        for ($i = 1; $i <= $this->count; $i++) {
            $a       = rand(2, 15);
            $d       = rand(2, 10);
            $s1 = $a;
            $s2 = $a + $d;
            $s3 = $a + 2 * $d;
            $s4 = $a + 3 * $d;
            $correct = $a + 4 * $d;
            $text    = "Perhatikan barisan angka: {$s1}, {$s2}, {$s3}, {$s4}, ... Berapakah angka selanjutnya?";
            $explanation = "Ini adalah barisan aritmatika dengan suku pertama (a) = {$a} dan beda (d) = {$d}. Suku ke-5 = {$a} + (5-1)×{$d} = {$a} + " . (4 * $d) . " = {$correct}.";

            $decoys  = $this->generateDecoys($correct, 3);
            $options = [$decoys[0], $decoys[1], $correct, $decoys[2]];

            $questions[] = [
                'id'          => $i,
                'text'        => "Soal No. {$i} [SNBT - Penalaran Umum]: " . $text,
                'options'     => [
                    'A' => (string)$options[0],
                    'B' => (string)$options[1],
                    'C' => (string)$options[2],
                    'D' => (string)$options[3],
                ],
                'correct'     => 'C',
                'explanation' => $explanation,
            ];
        }
        return $questions;
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
