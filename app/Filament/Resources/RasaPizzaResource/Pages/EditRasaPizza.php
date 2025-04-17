<?php

namespace App\Filament\Resources\RasaPizzaResource\Pages;

use App\Filament\Resources\RasaPizzaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRasaPizza extends EditRecord
{
    protected static string $resource = RasaPizzaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
            ->label('Kembali')
            ->url(route('filament.admin.resources.rasa-pizzas.index')),
        ];
    }
}
