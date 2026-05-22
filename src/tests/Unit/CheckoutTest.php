<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\Checkout\BasePaketBelajar;
use App\Services\Checkout\VoucherDiscountDecorator;
use App\Services\Checkout\PremiumFeatureDecorator;
use App\Services\Checkout\CheckoutContext;
use App\Services\Checkout\PackageValidationHandler;
use App\Services\Checkout\VoucherValidationHandler;
use App\Services\Checkout\PaymentMethodValidationHandler;
use Illuminate\Support\Facades\DB;
use stdClass;

class CheckoutTest extends TestCase
{
    public function test_paket_belajar_decorators()
    {
        $paketData = new stdClass();
        $paketData->nama = 'Paket Intensif UTBK';
        $paketData->harga = 100000.0;
        $paketData->deskripsi = 'Persiapan UTBK Intensif';
        $paketData->masa_aktif = 30;

        $basePaket = new BasePaketBelajar($paketData);
        $this->assertEquals('Paket Intensif UTBK', $basePaket->getNama());
        $this->assertEquals(100000.0, $basePaket->getHarga());
        $this->assertEquals(30, $basePaket->getMasaAktif());
        $this->assertContains('Materi belajar lengkap', $basePaket->getFeatures());

        $discountedPaket = new VoucherDiscountDecorator($basePaket, 25000.0);
        $this->assertEquals(75000.0, $discountedPaket->getHarga());
        $this->assertEquals('Paket Intensif UTBK', $discountedPaket->getNama());

        $heavilyDiscountedPaket = new VoucherDiscountDecorator($basePaket, 150000.0);
        $this->assertEquals(0.0, $heavilyDiscountedPaket->getHarga());

        $premiumDiscountedPaket = new PremiumFeatureDecorator($discountedPaket);
        $features = $premiumDiscountedPaket->getFeatures();
        $this->assertContains('Prioritas Tanya Guru via Chat', $features);
        $this->assertContains('Rangkuman Materi & E-Book Premium', $features);
        $this->assertEquals(75000.0, $premiumDiscountedPaket->getHarga());
    }

    public function test_checkout_context()
    {
        $context = new CheckoutContext(1, 10, null, 'DANA');
        $this->assertTrue($context->isSuccess);
        $this->assertNull($context->errorMessage);

        $context->fail('Metode pembayaran tidak valid.');
        $this->assertFalse($context->isSuccess);
        $this->assertEquals('Metode pembayaran tidak valid.', $context->errorMessage);
    }

    public function test_payment_method_validation()
    {
        $handler = new PaymentMethodValidationHandler();

        $context1 = new CheckoutContext(1, 10, null, 'DANA');
        $handler->handle($context1);
        $this->assertTrue($context1->isSuccess);

        $context2 = new CheckoutContext(1, 10, null, 'GoPay');
        $handler->handle($context2);
        $this->assertTrue($context2->isSuccess);

        $context3 = new CheckoutContext(1, 10, null, 'TransferBank');
        $handler->handle($context3);
        $this->assertFalse($context3->isSuccess);
        $this->assertEquals('Metode pembayaran tidak didukung.', $context3->errorMessage);

        $context4 = new CheckoutContext(1, 10, null, '');
        $handler->handle($context4);
        $this->assertFalse($context4->isSuccess);
        $this->assertEquals('Metode pembayaran harus dipilih.', $context4->errorMessage);
    }
}
