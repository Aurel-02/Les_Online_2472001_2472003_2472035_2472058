<?php

namespace App\Pattern\Ujian;

class SoalSMP implements SoalUjianInterface
{
    private int $count = 10;

    public function getQuestions(string $jenis, string $mapel): array
    {
        $questions = [];
        for ($i = 1; $i <= $this->count; $i++) {
            $type = rand(0, 1); // 0 = persamaan linear, 1 = keliling
            if ($type === 0) {
                $a    = rand(2, 8);
                $x    = rand(1, 12);
                $b    = rand(1, 15);
                $c    = $a * $x + $b;
                $correct = $x;
                $text    = "Jika {$a}x + {$b} = {$c}, berapakah nilai x?";
                $explanation = "Dari persamaan {$a}x + {$b} = {$c}, kita kurangkan kedua ruas dengan {$b}: {$a}x = " . ($c - $b) . ". Kemudian bagi kedua ruas dengan {$a}: x = {$x}.";
            } else {
                $p    = rand(5, 20);
                $l    = rand(3, 15);
                $total   = 2 * ($p + $l);
                $correct = $p;
                $text    = "Keliling persegi panjang adalah {$total} cm. Jika lebarnya {$l} cm, berapakah panjangnya?";
                $halfTotal = $total / 2;
                $explanation = "Keliling = 2(p + l) → {$total} = 2(p + {$l}) → p + {$l} = {$halfTotal} → p = {$halfTotal} - {$l} = {$p} cm.";
            }

            $decoys  = $this->generateDecoys($correct, 3);
            $options = [$decoys[0], $correct, $decoys[1], $decoys[2]];

<<<<<<< HEAD
            $questions[] = [
                'id'          => $i,
                'text'        => "Soal No. {$i}: " . $text,
                'options'     => [
                    'A' => (string)$options[0],
                    'B' => (string)$options[1],
                    'C' => (string)$options[2],
                    'D' => (string)$options[3],
                ],
                'correct'     => 'B',
                'explanation' => $explanation,
            ];
=======
            $optionsMap = [
                'A' => (string)$options[0],
                'B' => (string)$options[1],
                'C' => (string)$options[2],
                'D' => (string)$options[3],
            ];
            $flyweight = SoalFlyweightFactory::getFlyweight('', $text, $optionsMap, 'B', $explanation);
            $questions[] = $flyweight->render($i);
>>>>>>> f1477981be828601e79080bb40992bd330fffc3a
        }
        return $questions;
    }

    private function generateDecoys(int $correct, int $count): array
    {
        $decoys = [];
        $used   = [$correct];
        while (count($decoys) < $count) {
            $offset    = rand(-6, 6);
            if ($offset === 0) $offset = 2;
            $candidate = $correct + $offset;
            if ($candidate > 0 && !in_array($candidate, $used)) {
                $decoys[] = $candidate;
                $used[]   = $candidate;
            }
        }
        return $decoys;
    }
}
