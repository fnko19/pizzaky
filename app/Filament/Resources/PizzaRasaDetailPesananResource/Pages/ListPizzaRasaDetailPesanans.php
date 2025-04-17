<?php

namespace App\Filament\Resources\PizzaRasaDetailPesananResource\Pages;

use App\Filament\Resources\PizzaRasaDetailPesananResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPizzaRasaDetailPesanans extends ListRecords
{
    protected static string $resource = PizzaRasaDetailPesananResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
