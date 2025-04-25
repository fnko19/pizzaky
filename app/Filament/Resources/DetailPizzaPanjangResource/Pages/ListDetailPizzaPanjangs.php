<?php

namespace App\Filament\Resources\DetailPizzaPanjangResource\Pages;

use App\Filament\Resources\DetailPizzaPanjangResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDetailPizzaPanjangs extends ListRecords
{
    protected static string $resource = DetailPizzaPanjangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
