<?php

namespace App\Filament\Resources\CityCategoryResource\Pages;

use App\Filament\Resources\CityCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCityCategory extends EditRecord
{
    protected static string $resource = CityCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
