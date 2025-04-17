<?php

namespace App\Filament\Resources\PizzaRasaDetailPesananResource\Pages;

use App\Filament\Resources\PizzaRasaDetailPesananResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPizzaRasaDetailPesanan extends EditRecord
{
    protected static string $resource = PizzaRasaDetailPesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
            ->label('Kembali')
            ->url(route('filament.admin.resources.pizza-rasa-detail-pesanans.index')),
        ];
    }
}
