<?php

namespace App\Pattern\DAO;

use App\Models\Voucher;

class VoucherDAO
{
    public function getAllVouchers()
    {
        return Voucher::orderBy('id_voucher', 'desc')->get();
    }

    public function createVoucher(array $data)
    {
        return Voucher::create($data);
    }

    public function deleteVoucher($id)
    {
        $voucher = Voucher::findOrFail($id);
        return $voucher->delete();
    }
}
