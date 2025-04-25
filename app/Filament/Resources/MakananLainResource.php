<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MakananLainResource\Pages;
use App\Filament\Resources\MakananLainResource\RelationManagers;
use App\Models\MakananLain;
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

class MakananLainResource extends Resource
{
    protected static ?string $model = MakananLain::class;

    protected static ?string $navigationIcon = 'heroicon-o-cake';

    protected static ?string $navigationLabel = 'Makanan Lain';

    protected static ?string $navigationGroup = 'Menu Lain';

    protected static ?int $navigationSort = 3;

    public static ?string $label = 'Daftar Makanan Lain';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('nama_makanan')->label('Nama Makanan')->required(),
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
                    Textarea::make('deskripsi_singkatt')
                        ->label('Deskripsi Singkat')
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
                TextColumn::make('nama_makanan')->label('Nama Makanan')->sortable()->searchable(),
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->image_path))
                    ->label('Gambar'),
                TextColumn::make('harga')->label('Harga')->sortable(),
                TextColumn::make('stok')->label('Stok')->sortable(),
                TextColumn::make('deskripsi')->label('Deskripsi')->limit(50)
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
            'index' => Pages\ListMakananLains::route('/'),
            'create' => Pages\CreateMakananLain::route('/create'),
            'edit' => Pages\EditMakananLain::route('/{record}/edit'),
        ];
    }
}
