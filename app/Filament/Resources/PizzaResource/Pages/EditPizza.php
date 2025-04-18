<?php

namespace App\Filament\Resources\PizzaResource\Pages;

use App\Filament\Resources\PizzaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPizza extends EditRecord
{
    protected static string $resource = PizzaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('back')
            ->label('Kembali')
            ->url(route('filament.admin.resources.pizzas.index')),
        ];
    }
}
