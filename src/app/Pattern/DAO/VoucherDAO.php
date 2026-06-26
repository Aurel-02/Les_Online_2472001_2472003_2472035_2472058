<?php

namespace App\Pattern\DAO;

use App\Models\Voucher;
use App\Models\Transaksi;

class VoucherDAO
{
    public function getAllVouchers()
    {
        return Voucher::orderBy('id_voucher', 'desc')->get();
    }

    public function getActiveVouchers()
    {
        return Voucher::where('tanggal_berakhir', '>=', now()->toDateString())->get();
    }

    public function createVoucher(array $data)
    {
        return Voucher::create($data);
    }

    public function deleteVoucher($id)
    {
        $voucher = Voucher::findOrFail($id);

        // Nullify foreign key references in transaksi to avoid constraint violation
        Transaksi::where('id_voucher', $id)->update(['id_voucher' => null]);

        return $voucher->delete();
    }
}
