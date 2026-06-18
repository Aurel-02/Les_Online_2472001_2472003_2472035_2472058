<?php

namespace App\Pattern\Strategy;

use App\Models\Transaksi;

class WeeklyIncomeStrategy implements IncomeReportStrategy
{
    public function getChartData(): array
    {
        $chartDataRaw = Transaksi::where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->whereIn('status', ['sukses', 'berhasil'])
            ->selectRaw('DATE(created_at) as date, SUM(subtotal) as daily_income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $chartLabels[] = now()->subDays($i)->translatedFormat('d M');
            $match = $chartDataRaw->firstWhere('date', $date);
            $chartData[] = $match ? $match->daily_income : 0;
        }

        return [
            'labels' => $chartLabels,
            'data' => $chartData
        ];
    }
}
