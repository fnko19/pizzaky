<?php

namespace App\Filament\Resources\PizzaPanjangResource\Pages;

use App\Filament\Resources\PizzaPanjangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPizzaPanjangs extends ListRecords
{
    protected static string $resource = PizzaPanjangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
