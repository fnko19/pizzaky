<?php

namespace App\Filament\Resources\MakananLainResource\Pages;

use App\Filament\Resources\MakananLainResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMakananLain extends EditRecord
{
    protected static string $resource = MakananLainResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
            ->label('Kembali')
            ->url(route('filament.admin.resources.makanan-lains.index')),
        ];
    }
}
