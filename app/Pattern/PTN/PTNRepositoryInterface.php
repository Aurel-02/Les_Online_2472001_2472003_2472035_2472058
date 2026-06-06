<?php

namespace App\Pattern\PTN;

interface PTNRepositoryInterface
{
    /**
     * Get all PTN data.
     *
     * @return array
     */
    public function getAllPTN(): array;

    /**
     * Get data for all Fakultas.
     *
     * @return array
     */
    public function getAllFakultas(): array;

    /**
     * Get data for a specific Fakultas by name.
     *
     * @param string $nama
     * @return array|null
     */
    public function getFakultas(string $nama): ?array;

    /**
     * Get detailed data for a specific Jurusan (Prodi).
     *
     * @param string $nama
     * @return array|null
     */
    public function getJurusanDetail(string $nama): ?array;
}
