<?php

namespace App\Filament\Resources\DetailPesananResource\Pages;

use App\Filament\Resources\DetailPesananResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDetailPesanan extends CreateRecord
{
    protected static string $resource = DetailPesananResource::class;

    protected function afterCreate(): void
    {
        $selectedRasaIds = $this->form->getState()['rasa_pizzas'] ?? [];

        $this->record->rasaPizzas()->sync($selectedRasaIds);
    }

    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     $pizza = \App\Models\pizza::find($data['pizza_id']);
    //     if ($pizza) {
    //         $data['subtotal'] = $pizza->harga * $data['jumlah'];
    //     }
    
    //     return $data;
    // }
}
