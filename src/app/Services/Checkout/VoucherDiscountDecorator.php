<?php

namespace App\Services\Checkout;

class VoucherDiscountDecorator implements PaketBelajarInterface
{
    protected PaketBelajarInterface $paketBelajar;
    protected float $potongan;

    public function __construct(PaketBelajarInterface $paketBelajar, float $potongan)
    {
        $this->paketBelajar = $paketBelajar;
        $this->potongan = $potongan;
    }

    public function getNama(): string
    {
        return $this->paketBelajar->getNama();
    }

    public function getHarga(): float
    {
        $harga = $this->paketBelajar->getHarga() - $this->potongan;
        return max(0.0, $harga); // Price cannot be negative
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
        return $this->paketBelajar->getFeatures();
    }
}
