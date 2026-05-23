<?php

namespace App\Pattern\Ujian;

class SoalSD implements SoalUjianInterface
{
    private int $count = 10;

    public function getQuestions(string $jenis, string $mapel): array
    {
        $questions = [];
        for ($i = 1; $i <= $this->count; $i++) {
            $type = rand(0, 1); // 0 = penjumlahan, 1 = perkalian
            if ($type === 0) {
                $a       = rand(1, 20);
                $b       = rand(1, 20);
                $correct = $a + $b;
                $text    = "Berapakah hasil dari {$a} + {$b}?";
                $explanation = "Penjumlahan {$a} + {$b} = {$correct}. Caranya: mulai dari {$a}, tambahkan {$b} satu per satu, hasilnya adalah {$correct}.";
            } else {
                $a       = rand(2, 9);
                $b       = rand(2, 9);
                $correct = $a * $b;
                $text    = "Berapakah hasil dari {$a} × {$b}?";
                $explanation = "Perkalian {$a} × {$b} = {$correct}. Artinya, {$a} dijumlahkan sebanyak {$b} kali, atau sebaliknya.";
            }

            $decoys  = $this->generateDecoys($correct, 3);
            $options = [$decoys[0], $decoys[1], $correct, $decoys[2]];

            $questions[] = [
                'id'          => $i,
                'text'        => "Soal No. {$i}: " . $text,
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
            $offset    = rand(-5, 5);
            if ($offset === 0) $offset = 1;
            $candidate = $correct + $offset;
            if ($candidate > 0 && !in_array($candidate, $used)) {
                $decoys[] = $candidate;
                $used[]   = $candidate;
            }
        }
        return $decoys;
    }
}
