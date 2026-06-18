<?php

namespace App\Pattern\Strategy;

interface IncomeReportStrategy
{
    /**
     * Get the chart data and labels.
     * 
     * @return array ['labels' => [], 'data' => []]
     */
    public function getChartData(): array;
}
