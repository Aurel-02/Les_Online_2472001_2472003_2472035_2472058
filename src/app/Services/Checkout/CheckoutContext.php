<?php

namespace App\Services\Checkout;

class CheckoutContext
{
    public int $userId;
    public int $idPaket;
    public ?int $idVoucher = null;
    public ?string $metodePembayaran = null;
    public float $originalPrice = 0.0;
    public float $potongan = 0.0;
    public float $subtotal = 0.0;
    public string $status = 'berhasil';
    public $paket = null;
    public $voucher = null;
    
    // Status tracking for the Chain of Responsibility
    public bool $isSuccess = true;
    public ?string $errorMessage = null;

    public function __construct(int $userId, int $idPaket, ?int $idVoucher, ?string $metodePembayaran)
    {
        $this->userId = $userId;
        $this->idPaket = $idPaket;
        $this->idVoucher = $idVoucher;
        $this->metodePembayaran = $metodePembayaran;
    }

    public function fail(string $message): void
    {
        $this->isSuccess = false;
        $this->errorMessage = $message;
    }
}
