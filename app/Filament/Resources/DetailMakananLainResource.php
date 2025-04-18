<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailMakananLainResource\Pages;
use App\Filament\Resources\DetailMakananLainResource\RelationManagers;
use App\Models\detailMakananLain;
use App\Models\pesanan;
use App\Models\makananLain;
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

class DetailMakananLainResource extends Resource
{
    protected static ?string $model = detailMakananLain::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Menu Lain';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('pesanan_id')
                        ->label('Pesanan')
                        ->relationship('pesanan', 'id')
                        ->required(),

                    Select::make('makanan_lain_id')
                        ->label('Nama Makanan')
                        ->relationship('makananLain', 'nama_makanan')
                        ->required()
                        ->reactive(),

                    TextInput::make('jumlah')
                        ->numeric()
                        ->required()
                        ->reactive(),

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pesanan.id')->label('ID Pesanan'),
                TextColumn::make('makananLain.nama_makanan')->label('Nama Makanan'),
                TextColumn::make('jumlah')->label('Jumlah'),
                TextColumn::make('subtotal')->label('Subtotal'),
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
            'index' => Pages\ListDetailMakananLains::route('/'),
            'create' => Pages\CreateDetailMakananLain::route('/create'),
            'edit' => Pages\EditDetailMakananLain::route('/{record}/edit'),
        ];
    }
}
