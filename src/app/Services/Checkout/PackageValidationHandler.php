<?php

namespace App\Services\Checkout;

use Illuminate\Support\Facades\DB;

class PackageValidationHandler extends CheckoutHandler
{
    protected function process(CheckoutContext $context): void
    {
        $paket = DB::table('paket_pembelajaran')->where('id_paket', $context->idPaket)->first();

        if (!$paket) {
            $context->fail('Paket pembelajaran tidak ditemukan.');
            return;
        }

        // Check if the user already has this package active
        $existingActiveTransaction = DB::table('transaksi')
            ->join('paket_pembelajaran', 'transaksi.id_paket', '=', 'paket_pembelajaran.id_paket')
            ->where('transaksi.id_user', $context->userId)
            ->where('transaksi.id_paket', $context->idPaket)
            ->where('transaksi.status', 'berhasil')
            ->orderBy('transaksi.id_transaksi', 'desc')
            ->first();

        if ($existingActiveTransaction) {
            $createdAt = new \DateTime($existingActiveTransaction->created_at);
            $now = new \DateTime();
            
            $createdTimestamp = $createdAt->getTimestamp();
            $nowTimestamp = $now->getTimestamp();
            $secondsActive = (int)$existingActiveTransaction->masa_aktif * 24 * 3600;

            if ($nowTimestamp < ($createdTimestamp + $secondsActive)) {
                $context->fail('Anda sudah memiliki paket belajar ini yang masih aktif.');
                return;
            }
        }

        $context->paket = $paket;
        $context->originalPrice = (float) $paket->harga;
        $context->subtotal = (float) $paket->harga;
    }
}
