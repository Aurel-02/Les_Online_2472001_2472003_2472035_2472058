<?php

namespace App\Pattern\DAO;

use App\Models\Transaksi;

class TransaksiDAO
{
    public function getTotalIncome(): float
    {
        return Transaksi::whereIn('status', ['sukses', 'berhasil'])->sum('subtotal');
    }

    public function getTotalTransactions(): int
    {
        return Transaksi::count();
    }

    public function getIncomeChartData(\App\Pattern\Strategy\IncomeReportStrategy $strategy): array
    {
        return $strategy->getChartData();
    }
}
