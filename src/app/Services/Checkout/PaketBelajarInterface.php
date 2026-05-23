<?php

namespace App\Services\Checkout;

interface PaketBelajarInterface
{
    public function getNama(): string;
    public function getHarga(): float;
    public function getDeskripsi(): string;
    public function getMasaAktif(): int;
    public function getFeatures(): array;
}
