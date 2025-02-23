<?php

namespace App\Filament\Resources\EventResource\Pages;

use App\Filament\Resources\EventResource;
use App\Filament\Widgets\EventVisitorCityChart as WidgetsEventVisitorCityChart;
use App\Filament\Widgets\EventVisitorDeviceStats as WidgetsEventVisitorDeviceStats;
use App\Filament\Widgets\EventVisitorLocationChart as WidgetsEventVisitorLocationChart;
use App\Filament\Widgets\EventVisitorCityChart;
use App\Filament\Widgets\EventVisitorDeviceStats;
use App\Filament\Widgets\EventVisitorLocationChart;
use Filament\Resources\Pages\ViewRecord;
use Filament\Resources\Pages\EditRecord;

class ViewEvent extends ViewRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            WidgetsEventVisitorDeviceStats::make([
                'eventId' => $this->record->id,
            ]),
            WidgetsEventVisitorLocationChart::make([
                'eventId' => $this->record->id,
            ]),
            WidgetsEventVisitorCityChart::make([
                'eventId' => $this->record->id,
            ]),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}

class EditEvent extends EditRecord
{
    protected static string $resource = EventResource::class;

    protected function getHeaderWidgets(): array
    {
        $eventId = $this->record->id ?? null;

        return [
            EventVisitorDeviceStats::make(['eventId' => $eventId]),
            EventVisitorLocationChart::make(['eventId' => $eventId]),
            EventVisitorCityChart::make(['eventId' => $eventId]),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }
}
