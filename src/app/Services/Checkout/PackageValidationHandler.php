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

        $context->paket = $paket;
        $context->originalPrice = (float) $paket->harga;
        $context->subtotal = (float) $paket->harga;
    }
}
