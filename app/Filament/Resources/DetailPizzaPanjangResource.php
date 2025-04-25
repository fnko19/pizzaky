<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailPizzaPanjangResource\Pages;
use App\Filament\Resources\DetailPizzaPanjangResource\RelationManagers;
use App\Models\detailPizzaPanjang;
use App\Models\pesanan;
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

class DetailPizzaPanjangResource extends Resource
{
    protected static ?string $model = detailPizzaPanjang::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    
    protected static ?string $navigationLabel = 'Detail Pesanan Pizza Panjang';

    protected static ?string $navigationGroup = 'Pizza Panjang';

    protected static ?int $navigationSort = 4;

    public static ?string $label = 'Detail Pesanan Pizza Panjang';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('pesanan_id')
                        ->label('Pesanan')
                        ->relationship('pesanan', 'id')
                        ->required(),

                    Select::make('pizza_panjang_id')
                        ->label('Nama Pizza Panjang')
                        ->relationship('pizzaPanjang', 'nama_pizza')
                        ->required()
                        ->reactive(),

                    TextInput::make('jumlah')
                        ->numeric()
                        ->required()
                        ->reactive(),

                    TextInput::make('subtotal')
                        ->label('Subtotal')
                        ->disabled()
                        ->dehydrated(false)

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pesanan.id')->label('ID Pesanan'),
                TextColumn::make('pizzaPanjang.nama_pizza')->label('Nama Pizza'),
                TextColumn::make('jumlah')->label('Jumlah'),
                TextColumn::make('subtotal')->label('Subtotal'),
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
            'index' => Pages\ListDetailPizzaPanjangs::route('/'),
            'create' => Pages\CreateDetailPizzaPanjang::route('/create'),
            'edit' => Pages\EditDetailPizzaPanjang::route('/{record}/edit'),
        ];
    }
}
