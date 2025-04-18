<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PizzaRasaDetailPesananResource\Pages;
use App\Filament\Resources\PizzaRasaDetailPesananResource\RelationManagers;
use App\Models\pizza_rasa_detail_pesanan;
use App\Models\detailPesanan;
use App\Models\RasaPizza;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PizzaRasaDetailPesananResource extends Resource
{
    protected static ?string $model = pizza_rasa_detail_pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

    protected static ?string $navigationLabel = 'Rasa Tiap Orderan';

    protected static ?string $navigationGroup = 'Pizza';

    protected static ?int $navigationSort = 2;

    public static ?string $label = 'Keterangan Rasa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('detail_pesanan_id')
                        ->label('Detail Pesanan')
                        ->relationship('detailPesanan', 'id')
                        ->required(),

                    Select::make('rasa_pizza_id')
                        ->label('Rasa Pizza')
                        ->relationship('rasaPizza', 'nama_rasa')
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('detailPesanan.id')->label('ID Detail Pesanan'),
                TextColumn::make('rasaPizza.nama_rasa')->label('Rasa Pizza'),
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
            'index' => Pages\ListPizzaRasaDetailPesanans::route('/'),
            'create' => Pages\CreatePizzaRasaDetailPesanan::route('/create'),
            'edit' => Pages\EditPizzaRasaDetailPesanan::route('/{record}/edit'),
        ];
    }
}
