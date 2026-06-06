<?php

namespace App\Services\Checkout;

class PaymentMethodValidationHandler extends CheckoutHandler
{
    protected array $allowedMethods = ['DANA', 'GoPay', 'OVO', 'ShopeePay'];

    protected function process(CheckoutContext $context): void
    {
        if (empty($context->metodePembayaran)) {
            $context->fail('Metode pembayaran harus dipilih.');
            return;
        }

        if (!in_array($context->metodePembayaran, $this->allowedMethods)) {
            $context->fail('Metode pembayaran tidak didukung.');
            return;
        }
    }
}
