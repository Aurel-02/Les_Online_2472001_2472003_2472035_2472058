<?php

namespace App\Services\Checkout;

use Illuminate\Support\Facades\DB;

class VoucherValidationHandler extends CheckoutHandler
{
    protected function process(CheckoutContext $context): void
    {
        if ($context->idVoucher === null || $context->idVoucher === 0) {
            // No voucher applied, decorate with the PremiumFeatureDecorator
            $basePaket = new BasePaketBelajar($context->paket);
            $decoratedPaket = new PremiumFeatureDecorator($basePaket);
            $context->subtotal = $decoratedPaket->getHarga();
            return;
        }

        $voucher = DB::table('voucher')
            ->where('id_voucher', $context->idVoucher)
            ->where('tanggal_berakhir', '>=', now()->toDateString())
            ->first();

        if (!$voucher) {
            $context->fail('Voucher tidak valid atau sudah kedaluwarsa.');
            return;
        }

        $context->voucher = $voucher;
        $context->potongan = (float) $voucher->potongan;

        // Apply Voucher Decorator & PremiumFeatureDecorator
        $basePaket = new BasePaketBelajar($context->paket);
        $discountedPaket = new VoucherDiscountDecorator($basePaket, $context->potongan);
        $decoratedPaket = new PremiumFeatureDecorator($discountedPaket);

        $context->subtotal = $decoratedPaket->getHarga();
    }
}
