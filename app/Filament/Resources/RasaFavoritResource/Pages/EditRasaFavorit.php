<?php

namespace App\Filament\Resources\RasaFavoritResource\Pages;

use App\Filament\Resources\RasaFavoritResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRasaFavorit extends EditRecord
{
    protected static string $resource = RasaFavoritResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
