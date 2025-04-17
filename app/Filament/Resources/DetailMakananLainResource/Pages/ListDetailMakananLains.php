<?php

namespace App\Filament\Resources\DetailMakananLainResource\Pages;

use App\Filament\Resources\DetailMakananLainResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailMakananLains extends ListRecords
{
    protected static string $resource = DetailMakananLainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
