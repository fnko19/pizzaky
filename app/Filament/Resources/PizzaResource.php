<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PizzaResource\Pages;
use App\Filament\Resources\PizzaResource\RelationManagers;
use App\Models\pizza;
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

class PizzaResource extends Resource
{
    protected static ?string $model = pizza::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Daftar Pizza';

    protected static ?string $navigationGroup = 'Pizza';

    protected static ?int $navigationSort = 2;

    public static ?string $label = 'Pizza';

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
                    Select::make('ukuran')
                        ->label('Tipe Ukuran')
                        ->options([
                            'S' => 'S',
                            'M' => 'M',
                            'L' => 'L',
                            'Limo' => 'Limo',
                        ]),
                    TextInput::make('stok')
                        ->label('Stok')
                        ->numeric()
                        ->required(),
                    Textarea::make('deskripsi')
                        ->label('Deskripsi')
                        ->required(),
                    Textarea::make('deskripsi_singkat')
                        ->label('Deskripsi_singkat')
                        ->required(),
                    TextInput::make('max_rasa')
                        ->label('Batas Rasa')
                        ->numeric()
                        ->required(),
                    FileUpload::make('image_path')
                        ->directory('storage')
                        ->image()
                        ->imagePreviewHeight('200')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_pizza')->label('Nama Pizza')->sortable()->searchable(),
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->image_path))
                    ->label('Gambar'),
                TextColumn::make('harga')->label('Harga')->sortable(),
                TextColumn::make('ukuran')->label('Tipe Ukuran')->sortable(),
                TextColumn::make('stok')->label('Stok')->sortable(),
                TextColumn::make('deskripsi')->label('Deskripsi')->limit(50),
                TextColumn::make('deskripsi_singkat')->label('Deskripsi Singkat')->limit(50),
                TextColumn::make('max_rasa')->label('Batas Rasa')->sortable(),
                TextColumn::make('created_at')->label('Dibuat')->dateTime(),
                
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
            'index' => Pages\ListPizzas::route('/'),
            'create' => Pages\CreatePizza::route('/create'),
            'edit' => Pages\EditPizza::route('/{record}/edit'),
        ];
    }
}
