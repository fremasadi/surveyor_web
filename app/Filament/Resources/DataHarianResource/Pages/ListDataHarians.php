<?php

namespace App\Filament\Resources\DataHarianResource\Pages;

use App\Filament\Resources\DataHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDataHarians extends ListRecords
{
    protected static string $resource = DataHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
