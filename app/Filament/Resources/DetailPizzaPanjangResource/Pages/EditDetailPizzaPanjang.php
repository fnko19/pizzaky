<?php

namespace App\Filament\Resources\DetailPizzaPanjangResource\Pages;

use App\Filament\Resources\DetailPizzaPanjangResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailPizzaPanjang extends EditRecord
{
    protected static string $resource = DetailPizzaPanjangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
