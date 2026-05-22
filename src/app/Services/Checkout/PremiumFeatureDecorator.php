<?php

namespace App\Services\Checkout;

class PremiumFeatureDecorator implements PaketBelajarInterface
{
    protected PaketBelajarInterface $paketBelajar;

    public function __construct(PaketBelajarInterface $paketBelajar)
    {
        $this->paketBelajar = $paketBelajar;
    }

    public function getNama(): string
    {
        return $this->paketBelajar->getNama();
    }

    public function getHarga(): float
    {
        return $this->paketBelajar->getHarga();
    }

    public function getDeskripsi(): string
    {
        return $this->paketBelajar->getDeskripsi();
    }

    public function getMasaAktif(): int
    {
        return $this->paketBelajar->getMasaAktif();
    }

    public function getFeatures(): array
    {
        $features = $this->paketBelajar->getFeatures();
        $features[] = 'Prioritas Tanya Guru via Chat';
        $features[] = 'Rangkuman Materi & E-Book Premium';
        return array_unique($features);
    }
}
