<?php

namespace App\Filament\Resources\DataHarianResource\Pages;

use App\Filament\Resources\DataHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Pages\Actions\Action;

class ListDataHarians extends ListRecords
{
    protected static string $resource = DataHarianResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Action::make('cetak_pdf')
            ->label('Cetak PDF')
            ->icon('heroicon-o-printer')
            ->form([
                Forms\Components\DatePicker::make('tanggal')
                    ->label('Tanggal')
                    ->required(),
            ])
            ->action(function (array $data) {
                $tanggal = $data['tanggal'];
                $url = route('data-harian.cetak-pdf', ['tanggal' => $tanggal]);

                return redirect($url);
            })
            ->color('success'),
        ];
    }


}
