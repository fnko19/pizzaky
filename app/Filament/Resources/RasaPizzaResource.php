<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RasaPizzaResource\Pages;
use App\Filament\Resources\RasaPizzaResource\RelationManagers;
use App\Models\RasaPizza;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RasaPizzaResource extends Resource
{
    protected static ?string $model = RasaPizza::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document';

    protected static ?string $navigationLabel = 'Daftar Rasa Pizza';

    protected static ?string $navigationGroup = 'Pizza';

    protected static ?int $navigationSort = 2;

    public static ?string $label = 'Daftar Rasa Pizza';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_rasa')
                        ->label('Nama Rasa')
                        ->required(),

                    TextInput::make('deskripsi')
                        ->label('Deskripsi')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_rasa')->label('Nama Rasa'),
                TextColumn::make('deskripsi')->label('Deskripsi'),
            ])
            ->filters([
                //
            ])
            ->actions([
            Tables\Actions\EditAction::make()
                ->label('')
                ->color('info')
                ->tooltip('Edit'),
            Tables\Actions\DeleteAction::make()
                ->label('')
                ->color('danger')
                ->tooltip('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRasaPizzas::route('/'),
            'create' => Pages\CreateRasaPizza::route('/create'),
            'edit' => Pages\EditRasaPizza::route('/{record}/edit'),
        ];
    }
}
