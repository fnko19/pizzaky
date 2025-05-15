<?php

namespace App\Filament\Resources\PesananResource\Pages;

use App\Filament\Resources\PesananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Forms;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualanExport;
use Illuminate\Http\Request;

class ListPesanans extends ListRecords
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('export')
                ->label('Export Laporan')
                ->icon('heroicon-o-folder-arrow-down')
                ->form([
                    Forms\Components\Select::make('bulan')
                        ->label('Pilih Bulan')
                        ->options(
                            collect(range(0, 11))->mapWithKeys(function ($i) {
                                $date = \Carbon\Carbon::now()->subMonths($i);
                                $key = $date->format('Y-m'); // untuk query
                                $label = $date->translatedFormat('F Y'); // untuk user (ex: "Maret 2025")
                                return [$key => $label];
                            })
                        )
                        ->required(),
                ])
                ->action(function (array $data) {
                    $bulan = $data['bulan'];
                    \Log::info('Bulan yang dipilih: ' . $bulan); // Debugging
                    return Excel::download(
                        new \App\Exports\LaporanPenjualanExport($bulan),
                        'laporan_penjualan_' . $bulan . '.xlsx'
                    );
                }),
            Actions\CreateAction::make(),
        ];
    }
}

