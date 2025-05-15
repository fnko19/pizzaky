<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetailPesananResource\Pages;
use App\Filament\Resources\DetailPesananResource\RelationManagers;
use App\Models\detailPesanan;
use App\Models\pesanan;
use App\Models\pizza;
use App\Models\RasaPizza;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DetailPesananResource extends Resource
{
    protected static ?string $model = detailPesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Pizza';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Select::make('pesanan_id')
                        ->label('Pesanan')
                        ->relationship('pesanan', 'id')
                        ->required(),

                    Select::make('pizza_id')
                        ->label('Jenis Pizza')
                        ->relationship('pizza', 'nama_pizza')
                        ->required()
                        ->reactive(),
                    
                    Select::make('rasa_pizzas')
                        ->label('Rasa Pizza')
                        ->options(RasaPizza::all()->pluck('nama_rasa', 'id'))
                        ->multiple()
                        ->required()
                        ->reactive()
                        ->default(function ($get, $record) {
                            return $record ? $record->rasaPizzas->pluck('id')->toArray() : [];
                        })
                        ->rule(function (callable $get) {
                            $pizza = \App\Models\pizza::find($get('pizza_id'));
                            $maxRasa = $pizza?->max_rasa ?? 1;
                    
                            return function ($attribute, $value, $fail) use ($maxRasa) {
                                if (is_array($value) && count($value) > $maxRasa) {
                                    $fail("Jumlah rasa maksimal untuk pizza ini adalah $maxRasa.");
                                }
                            };
                        }),

                    // Select::make('ekstraTopping')
                    //     ->label('Ekstra Topping')
                    //     ->options([
                    //         'Keju' => 'Keju',
                    //     ]),
                    Select::make('ekstraTopping')
                        ->label('Ekstra Topping')
                        ->options([
                            'Keju' => 'Keju',
                        ])
                        ->reactive()
                        ->disabled(function (callable $get) {
                            $pizza = \App\Models\pizza::find($get('pizza_id'));
                            return $pizza?->ukuran === 'S';
                        }),

                    Select::make('ekstraPinggiran')
                        ->label('Ekstra Pinggiran')
                        ->options([
                        'Sosis' => 'Sosis',
                        'Keju' => 'Keju',
                        ])
                        ->reactive()
                        ->disabled(function (callable $get) {
                            $pizza = \App\Models\pizza::find($get('pizza_id'));
                            return $pizza?->ukuran === 'S';
                    }),

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
                TextColumn::make('pizza.nama_pizza')->label('Ukuran Pizza'),
                TextColumn::make('jumlah')->label('Jumlah'),
                TextColumn::make('subtotal')->label('Subtotal'),
                TextColumn::make('ekstraTopping')->label('Ekstra Topping'),
                TextColumn::make('ekstraPinggiran')->label('Ekstra Pinggiran'),
                TextColumn::make('rasaPizzas')
                    ->label('Rasa Pizza')
                    ->getStateUsing(function ($record) {
                        return $record->rasaPizzas->pluck('nama_rasa')->join(', ');
                }),
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
            'index' => Pages\ListDetailPesanans::route('/'),
            'create' => Pages\CreateDetailPesanan::route('/create'),
            'edit' => Pages\EditDetailPesanan::route('/{record}/edit'),
        ];
    }
}
