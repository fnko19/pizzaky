<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PizzaPanjangResource\Pages;
use App\Filament\Resources\PizzaPanjangResource\RelationManagers;
use App\Models\pizzaPanjang;
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

class PizzaPanjangResource extends Resource
{
    protected static ?string $model = pizzaPanjang::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';
    
    protected static ?string $navigationLabel = 'Daftar Pizza Panjang';

    protected static ?string $navigationGroup = 'Pizza Panjang';

    protected static ?int $navigationSort = 4;

    public static ?string $label = 'Pizza Panjang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('nama_pizza')->label('Nama Pizza')->required(),
                    TextInput::make('harga')
                        ->label('Harga')
                        ->numeric()
                        ->required(),
                    TextInput::make('stok')
                        ->label('Stok')
                        ->numeric()
                        ->required(),
                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->required(),
                    Textarea::make('desc_singkat')
                        ->label('Deskripsi')
                        ->required(),
                    FileUpload::make('image_path')
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
                TextColumn::make('nama_pizza')->label('Nama PIzza')->sortable()->searchable(),
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->image_path))
                    ->label('Gambar Pizza Panjang'),
                TextColumn::make('harga')->label('Harga')->sortable(),
                TextColumn::make('stok')->label('Stok')->sortable(),
                TextColumn::make('deskripsi')->label('Deskripsi'),
                TextColumn::make('desc_singkat')->label('Deskripsi Singkat'),
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
            'index' => Pages\ListPizzaPanjangs::route('/'),
            'create' => Pages\CreatePizzaPanjang::route('/create'),
            'edit' => Pages\EditPizzaPanjang::route('/{record}/edit'),
        ];
    }
}
