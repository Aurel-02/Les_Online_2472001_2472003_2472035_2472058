<?php

namespace App\Services\Checkout;

use Illuminate\Support\Facades\DB;
use App\Models\Activity;

class TransactionStorageHandler extends CheckoutHandler
{
    protected function process(CheckoutContext $context): void
    {
        try {
            DB::beginTransaction();

            // Insert into transaksi table
            DB::table('transaksi')->insert([
                'id_user' => $context->userId,
                'id_paket' => $context->idPaket,
                'id_voucher' => $context->idVoucher,
                'subtotal' => $context->subtotal,
                'status' => $context->status, // 'berhasil'
                'metode_pembayaran' => $context->metodePembayaran,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Insert log into activities table
            // Menggunakan Observer Pattern untuk Notifikasi
            \App\Pattern\Observer\ActivityNotifier::getInstance()->notify([
                'user_id' => $context->userId,
                'type' => 'transaksi',
                'description' => "Membeli paket " . $context->paket->nama . " seharga " . number_format($context->subtotal, 0, ',', '.') . ($context->voucher ? ' dengan voucher ' . $context->voucher->kode_voucher : '')
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $context->fail('Gagal memproses transaksi di database: ' . $e->getMessage());
        }
    }
}
