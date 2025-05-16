<?php

namespace App\Filament\Resources\DataHarianResource\Pages;

use App\Filament\Resources\DataHarianResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

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
                    DatePicker::make('tanggal')
                        ->label('Tanggal')
                        ->required()
                        ->displayFormat('d/m/Y')
                        ->default(now()),
                ])
                ->action(function (array $data) {
                    // Log aksi cetak untuk debugging
                    Log::info('Cetak PDF dengan tanggal: ', $data);

                    $tanggal = $data['tanggal'];
                    // Pastikan format tanggal sesuai dengan yang diharapkan
                    $formattedDate = $tanggal instanceof \Carbon\Carbon
                        ? $tanggal->format('Y-m-d')
                        : $tanggal;

                    // Buat URL dengan query string yang benar
                    $url = route('data-harian.cetak-pdf', ['tanggal' => $formattedDate]);

                    // Debug URL
                    Log::info('URL PDF: ' . $url);

                    // Gunakan cara ini untuk membuka di tab baru
                    $this->js("window.open('$url', '_blank')");
                })
                ->color('success'),
        ];
    }


}
