<?php

namespace App\Pattern\Ujian;

interface SoalUjianInterface
{
    /**
     * Get the questions for a specific exam type and subject.
     *
     * @param string $jenis Jenis ujian (uts, uas, tryout)
     * @param string $mapel Mata Pelajaran
     * @return array Array of questions
     */
    public function getQuestions(string $jenis, string $mapel): array;
}
