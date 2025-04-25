<?php

namespace App\Filament\Resources\PizzaPanjangResource\Pages;

use App\Filament\Resources\PizzaPanjangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPizzaPanjang extends EditRecord
{
    protected static string $resource = PizzaPanjangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
