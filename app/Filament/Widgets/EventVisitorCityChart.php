<?php

namespace App\Filament\Widgets;

use App\Models\EventVisitor;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EventVisitorCityChart extends ChartWidget
{
    protected static ?string $heading = 'Top Cities';

    protected function getData(): array
    {
        $data = EventVisitor::select('city', DB::raw('count(*) as total'))
            ->whereNotNull('city')
            ->groupBy('city')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Visitors by City',
                    'data' => $data->pluck('total')->toArray(),
                    'backgroundColor' => '#4BC0C0',
                ],
            ],
            'labels' => $data->pluck('city')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
