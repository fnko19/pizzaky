<?php

namespace App\Filament\Resources\PesananResource\Pages;

use App\Filament\Resources\PesananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\detailPesanan;
use App\Models\detailMakananLain;
use App\Models\detailPizzaPanjang;

class EditPesanan extends EditRecord
{
    protected static string $resource = PesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
            ->label('Kembali')
            ->url(route('filament.admin.resources.pesanans.index')),
        ];
    }

    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     $data['total_harga'] = detailPesanan::where('pesanan_id', $this->record->id)->sum('subtotal');
    //     return $data;
    // }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // $totalPizza = detailPesanan::where('pesanan_id', $this->record->id)->sum('subtotal');
        // $totalMakananLain = detailMakananLain::where('pesanan_id', $this->record->id)->sum('subtotal');
        // $totalPizzaPanjang = detailPizzaPanjang::where('pesanan_id', $pesananId)->sum('subtotal');

    
        // $data['total_harga'] = $totalPizza + $totalMakananLain + $totalPizzaPanjang;
        // $data['total_bayar'] = $total + ($data['ongkir'] ?? 0);
        $total = \App\Models\detailPesanan::where('pesanan_id', $this->record->id)->sum('subtotal')
        + \App\Models\detailMakananLain::where('pesanan_id', $this->record->id)->sum('subtotal')
        + \App\Models\detailPizzaPanjang::where('pesanan_id', $this->record->id)->sum('subtotal');

        $data['total_harga'] = $total;
        $data['total_bayar'] = $total + ($data['ongkir'] ?? 0);
    
        return $data;
    }

}

    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     // Hitung dari fungsi model agar lengkap
    //     detailPesanan::updateTotalHarga($this->record->id);
        
    //     // Ambil ulang totalnya
    //     $data['total_harga'] = $this->record->fresh()->total_harga;
    
    //     return $data;
    // }


        // protected function afterSave(): void
    // {
    //     parent::afterSave();
    //     \App\Models\detailPesanan::updateTotalHarga($this->record->id);
    // }
