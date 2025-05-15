<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class DashboardStatsWidget extends BaseWidget
{
    protected ?string $heading = 'Statistik';

    protected function getCards(): array
    {
        $stats = $this->getDashboardStats(); // tanpa parameter bulan

        return [
            Stat::make('Total Pizza', number_format($stats['totalPizza'], 0, ',', '.'))
                ->description('Pemasukan dari Pizza')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Jumlah Pizza', $stats['jumlahPizza'])
                ->description('Jumlah Pesanan Pizza')
                ->icon('heroicon-o-cake'),

            Stat::make('Total Makanan Lain', number_format($stats['totalMakananLain'], 0, ',', '.'))
                ->description('Pemasukan dari Makanan Lain')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Jumlah Makanan Lain', $stats['jumlahMakananLain'])
                ->description('Jumlah Pesanan Makanan Lain')
                ->icon('heroicon-o-chart-bar'),

            Stat::make('Total Pizza Panjang', number_format($stats['totalPizzaPanjang'], 0, ',', '.'))
                ->description('Pemasukan dari Pizza Panjang')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Jumlah Pizza Panjang', $stats['jumlahPizzaPanjang'])
                ->description('Jumlah Pesanan Pizza Panjang')
                ->icon('heroicon-o-chart-bar'),

            Stat::make('Total Pemasukan', number_format($stats['totalKeseluruhan'], 0, ',', '.'))
                ->description('Pemasukan Keseluruhan')
                ->icon('heroicon-o-banknotes'),

            Stat::make('Jumlah Keseluruhan', $stats['jumlahKeseluruhan'])
                ->description('Jumlah Pesanan Keseluruhan')
                ->icon('heroicon-o-shopping-cart'),
        ];
    }

    public function getDashboardStats()
    {
        $totalPizza = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->sum('detail_pesanans.subtotal');

        $jumlahPizza = DB::table('detail_pesanans')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->count();

        $totalMakananLain = DB::table('detail_makanan_lains')
            ->join('pesanans', 'detail_makanan_lains.pesanan_id', '=', 'pesanans.id')
            ->sum('detail_makanan_lains.subtotal');

        $jumlahMakananLain = DB::table('detail_makanan_lains')
            ->join('pesanans', 'detail_makanan_lains.pesanan_id', '=', 'pesanans.id')
            ->count();

        $totalPizzaPanjang = DB::table('detail_pizza_panjangs')
            ->join('pesanans', 'detail_pizza_panjangs.pesanan_id', '=', 'pesanans.id')
            ->sum('detail_pizza_panjangs.subtotal');

        $jumlahPizzaPanjang = DB::table('detail_pizza_panjangs')
            ->join('pesanans', 'detail_pizza_panjangs.pesanan_id', '=', 'pesanans.id')
            ->count();

        return [
            'totalPizza' => $totalPizza,
            'jumlahPizza' => $jumlahPizza,
            'totalMakananLain' => $totalMakananLain,
            'jumlahMakananLain' => $jumlahMakananLain,
            'totalPizzaPanjang' => $totalPizzaPanjang,
            'jumlahPizzaPanjang' => $jumlahPizzaPanjang,
            'totalKeseluruhan' => $totalPizza + $totalMakananLain + $totalPizzaPanjang,
            'jumlahKeseluruhan' => $jumlahPizza + $jumlahMakananLain + $jumlahPizzaPanjang,
        ];
    }
}
