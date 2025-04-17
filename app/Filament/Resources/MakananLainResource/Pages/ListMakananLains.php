<?php

namespace App\Filament\Resources\MakananLainResource\Pages;

use App\Filament\Resources\MakananLainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMakananLains extends ListRecords
{
    protected static string $resource = MakananLainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
