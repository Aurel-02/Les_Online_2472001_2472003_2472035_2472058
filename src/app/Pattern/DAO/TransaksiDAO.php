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

    public function getWeeklyIncomeChartDataRaw()
    {
        return Transaksi::where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->whereIn('status', ['sukses', 'berhasil'])
            ->selectRaw('DATE(created_at) as date, SUM(subtotal) as daily_income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
