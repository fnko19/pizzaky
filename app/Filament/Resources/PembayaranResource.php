<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PembayaranResource\Pages;
use App\Filament\Resources\PembayaranResource\RelationManagers;
use App\Models\pembayaran;
use App\Models\pesanan;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PembayaranResource extends Resource
{
    protected static ?string $model = pembayaran::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('pesanan_id')
                        ->label('Nomor Pesanan')
                        ->options(fn () => pesanan::pluck('id', 'id'))
                        ->nullable(),
                    Select::make('metode_bayar')
                        ->label('Metode Pembayaran')
                        ->options([
                            'COD' => 'COD',
                            'Transfer' => 'Transfer',
                        ])
                        ->reactive(),
                    Select::make('status_bayar')
                        ->label('Status Pembayaran')
                        ->options(fn (callable $get) => $get('metode_bayar') === 'COD'
                            ? [
                                'Belum di Bayar' => 'Belum di Bayar',
                                'Lunas' => 'Lunas',
                            ]
                            : [
                                'Menunggu Dikonfirmasi' => 'Menunggu Dikonfirmasi',
                                'Lunas' => 'Lunas',

                            ]
                        )
                        ->reactive()
                        ->required(),
                    FileUpload::make('image_path')
                        ->directory('public')
                        ->image()
                        ->required(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pesanan_id')
                    ->label('Nomor Pesanan')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('metode_bayar')
                    ->label('Metode Pembayaran')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'COD' => 'gray',
                        'Transfer' => 'blue',
                        default => 'gray',
                    }),

                TextColumn::make('status_bayar')
                    ->label('Status Pembayaran')
                    ->sortable()
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Belum di Bayar' => 'danger',
                        'Lunas' => 'success',
                        'Menunggu Dikonfirmasi' => 'warning',
                        default => 'gray',
                    }),
                ImageColumn::make('image_path')
                    ->disk('public')
                    ->getStateUsing(fn ($record) => asset('storage/' . $record->image_path))
                    ->label('Bukti Transfer'),
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
            'index' => Pages\ListPembayarans::route('/'),
            'create' => Pages\CreatePembayaran::route('/create'),
            'edit' => Pages\EditPembayaran::route('/{record}/edit'),
        ];
    }
}
