<?php

namespace App\Filament\Resources\DetailPesananResource\Pages;

use App\Filament\Resources\DetailPesananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailPesanan extends EditRecord
{
    protected static string $resource = DetailPesananResource::class;

    protected function afterSave(): void
    {
        $selectedRasaIds = $this->form->getState()['rasa_pizzas'] ?? [];

        $this->record->rasaPizzas()->sync($selectedRasaIds);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
            ->label('Kembali')
            ->url(route('filament.admin.resources.detail-pesanans.index')),
        ];
    }

    // protected function mutateFormDataBeforeSave(array $data): array
    // {
    //     $pizza = \App\Models\pizza::find($data['pizza_id']);
    //     if ($pizza) {
    //         $data['subtotal'] = $pizza->harga * $data['jumlah'];
    //     }
    
    //     return $data;
    // }
}
