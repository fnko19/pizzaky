<?php

namespace App\Filament\Resources\RasaPizzaResource\Pages;

use App\Filament\Resources\RasaPizzaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRasaPizzas extends ListRecords
{
    protected static string $resource = RasaPizzaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
