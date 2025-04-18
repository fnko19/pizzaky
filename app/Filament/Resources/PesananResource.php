<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PesananResource\Pages;
use App\Filament\Resources\PesananResource\RelationManagers;
use App\Models\pesanan;
use App\Models\User;
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

class PesananResource extends Resource
{
    protected static ?string $model = pesanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    Select::make('user_id')
                        ->label('Nama Customer')
                        ->options(fn () => User::pluck('name', 'id')) 
                        ->nullable(),
                    TextInput::make('total_harga')
                        ->label('Total Pesanan')
                        ->nullable()
                        ->disabled(),
                    Select::make('opsi_pengambilan')
                        ->options([
                            'Ambil di Toko' => 'Ambil di Toko',
                            'Antar ke Rumah' => 'Antar ke Rumah',
                        ])
                        ->reactive(),
                    Select::make('status_pesanan')
                        ->label('Status Pesanan')
                        ->options(fn (callable $get) => $get('opsi_pengambilan') === 'Ambil di Toko'
                            ? [
                                'Diterima' => 'Diterima',
                                'Sedang di Proses' => 'Sedang di Proses',
                                'Siap Diambil' => 'Siap Diambil',
                            ]
                            : [
                                'Diterima' => 'Diterima',
                                'Sedang Dikirim' => 'Sedang Dikirim',
                                'Selesai' => 'Selesai',
                            ]
                        )
                        ->reactive(),

                    TextInput::make('whatsapp_driver')
                        ->label('Nomor WhatsApp Driver')
                        ->helperText('Gunakan format 628xxxxxx')
                        ->tel(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Customer'),
                TextColumn::make('total_harga')
                    ->label('Total Pesanan'),
                    //->getStateUsing(fn ($record) => $record->skor_kematangan)
                TextColumn::make('opsi_pengambilan')
                    ->label('Opsi Pengambilan'),
                TextColumn::make('status_pesanan')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Diterima' => 'gray',
                        'Sedang di Proses' => 'warning',
                        'Siap Diambil' => 'success',
                        'Sedang Dikirim' => 'warning',
                        'Selesai' => 'success',
                        default => 'gray',
                    }),
                TextColumn::make('whatsapp_driver')
                    ->label('Nomor Driver'),

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
            'index' => Pages\ListPesanans::route('/'),
            'create' => Pages\CreatePesanan::route('/create'),
            'edit' => Pages\EditPesanan::route('/{record}/edit'),
        ];
    }
}
