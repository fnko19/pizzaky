<?php

namespace App\Filament\Resources\DetailMakananLainResource\Pages;

use App\Filament\Resources\DetailMakananLainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDetailMakananLain extends EditRecord
{
    protected static string $resource = DetailMakananLainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
                ->label('Kembali')
                ->url(route('filament.admin.resources.detail-makanan-lains.index')),
        ];
    }
}
