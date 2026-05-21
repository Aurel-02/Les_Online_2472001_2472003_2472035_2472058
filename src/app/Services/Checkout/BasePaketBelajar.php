<?php

namespace App\Services\Checkout;

class BasePaketBelajar implements PaketBelajarInterface
{
    protected $paket;

    public function __construct($paket)
    {
        $this->paket = $paket;
    }

    public function getNama(): string
    {
        return $this->paket->nama;
    }

    public function getHarga(): float
    {
        return (float) $this->paket->harga;
    }

    public function getDeskripsi(): string
    {
        return $this->paket->deskripsi ?? '';
    }

    public function getMasaAktif(): int
    {
        return (int) $this->paket->masa_aktif;
    }

    public function getFeatures(): array
    {
        return [
            'Materi belajar lengkap',
            'Latihan soal interaktif',
            'Akses kapan saja!'
        ];
    }
}
