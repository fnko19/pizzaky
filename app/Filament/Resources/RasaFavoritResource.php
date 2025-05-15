<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RasaFavoritResource\Pages;
use App\Filament\Resources\RasaFavoritResource\RelationManagers;
use App\Models\RasaFavorit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RasaFavoritResource extends Resource
{
    protected static ?string $model = RasaFavorit::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';

    protected static ?string $navigationLabel = 'Rasa Favorit';

    public static ?string $label = 'Rasa Favorit';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('bulan')->label('Bulan')->required(),
                    TextInput::make('nama_rasa')->label('Nama Rasa')->required(),
                    Textarea::make('desc_singkat')
                        ->label('Deskripsi')
                        ->required(),
                    FileUpload::make('image_path')
                        ->label('Gambar')
                        ->directory('storage')
                        ->image()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('bulan')->label('Bulan')->sortable()->searchable(),
                TextColumn::make('nama_rasa')->label('Nama Rasa')->sortable()->searchable(),
                ImageColumn::make('image_path')
                    ->disk('storage')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->image_path))
                    ->label('Gambar'),
                TextColumn::make('desc_singkat')->label('Deskripsi'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListRasaFavorits::route('/'),
            'create' => Pages\CreateRasaFavorit::route('/create'),
            'edit' => Pages\EditRasaFavorit::route('/{record}/edit'),
        ];
    }
}
