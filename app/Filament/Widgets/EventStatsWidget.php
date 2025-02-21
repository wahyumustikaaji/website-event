<?php

namespace App\Filament\Widgets;

use App\Models\Event;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class EventStatsWidget extends ChartWidget
{
    protected static ?string $heading = 'Events Overview';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $monthlyEvents = Event::query()
            ->selectRaw('DATE(event_date) as date, COUNT(*) as count, SUM(views) as total_views')
            ->whereMonth('event_date', '=', now()->month)
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $activeEvents = Event::where('event_date', '>=', now())
            ->where(function ($query) {
                $query->where('end_date', '>=', now())
                    ->orWhereNull('end_date');
            })
            ->count();

        $totalEvents = Event::count();
        $totalViews = Event::sum('views');
        $averageTickets = Event::avg('ticket_quantity');

        return [
            'datasets' => [
                [
                    'label' => 'Events',
                    'data' => $monthlyEvents->pluck('count')->toArray(),
                    'backgroundColor' => '#4BC0C0',
                ],
                [
                    'label' => 'Views',
                    'data' => $monthlyEvents->pluck('total_views')->toArray(),
                    'backgroundColor' => '#FF9F40',
                ],
            ],
            'labels' => $monthlyEvents->pluck('date')->map(function ($date) {
                return Carbon::parse($date)->format('d M');
            })->toArray(),
            'extraData' => [
                'Active Events' => $activeEvents,
                'Total Events' => $totalEvents,
                'Total Views' => number_format($totalViews),
                'Average Tickets per Event' => round($averageTickets),
            ],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
