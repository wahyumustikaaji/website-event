<?php

namespace App\Filament\Widgets;

use App\Models\EventVisitor;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class EventVisitorDeviceStats extends BaseWidget
{
    protected function getStats(): array
    {
        $devices = EventVisitor::select('device', DB::raw('count(*) as total'))
            ->whereNotNull('device')
            ->groupBy('device')
            ->get();

        $browsers = EventVisitor::select('browser', DB::raw('count(*) as total'))
            ->whereNotNull('browser')
            ->groupBy('browser')
            ->get();

        $totalVisitors = EventVisitor::count();

        return [
            Stat::make('Total Visitors', $totalVisitors)
                ->description('Unique visitors')
                ->descriptionIcon('heroicon-m-cursor-arrow-rays')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),

            Stat::make('Top Device', $devices->sortByDesc('total')->first()?->device ?? 'N/A')
                ->description($devices->sortByDesc('total')->first()?->total . ' visitors')
                ->descriptionIcon('heroicon-m-device-phone-mobile'),

            Stat::make('Top Browser', $browsers->sortByDesc('total')->first()?->browser ?? 'N/A')
                ->description($browsers->sortByDesc('total')->first()?->total . ' visitors')
                ->descriptionIcon('heroicon-m-globe-alt'),
        ];
    }
}
