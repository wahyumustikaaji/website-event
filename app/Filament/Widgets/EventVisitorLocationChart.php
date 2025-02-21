<?php

namespace App\Filament\Widgets;

use App\Models\EventVisitor;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EventVisitorLocationChart extends ChartWidget
{
    protected static ?string $heading = 'Visitor Locations';

    protected function getData(): array
    {
        $data = EventVisitor::select('country', DB::raw('count(*) as total'))
            ->whereNotNull('country')
            ->groupBy('country')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visitors by Country',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0',
                        '#9966FF',
                        '#FF9F40',
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4BC0C0'
                    ],
                ],
            ],
            'labels' => $data->pluck('country')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
