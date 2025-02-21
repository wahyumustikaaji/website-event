<?php

namespace App\Filament\Widgets;

use App\Models\Payment;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class RevenueChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Revenue Overview';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Payment::query()
            ->where('status', 'paid')
            ->whereNotNull('paid_at')
            ->whereMonth('paid_at', '=', now()->month)
            ->selectRaw('DATE(paid_at) as date,
                        SUM(total_amount) as total_amount,
                        COUNT(*) as transaction_count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $totalRevenue = Payment::where('status', 'paid')
            ->whereNotNull('paid_at')
            ->sum('total_amount');

        $monthlyRevenue = $data->sum('total_amount');

        return [
            'datasets' => [
                [
                    'label' => 'Daily Revenue',
                    'data' => $data->pluck('total_amount')->toArray(),
                    'borderColor' => '#36A2EB',
                    'fill' => 'start',
                    'backgroundColor' => 'rgba(54, 162, 235, 0.1)',
                ],
            ],
            'labels' => $data->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('d M');
            })->toArray(),
            'extraData' => [
                'Total Revenue: Rp ' . number_format($totalRevenue, 0, ',', '.'),
                'Monthly Revenue: Rp ' . number_format($monthlyRevenue, 0, ',', '.'),
                'Total Transactions: ' . $data->sum('transaction_count'),
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
