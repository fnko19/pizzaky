<?php 

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class LaporanPenjualanExport implements FromCollection, WithHeadings, WithEvents
{
    protected $bulan;

    public function __construct($bulan)
    {
        $this->bulan = $bulan;
    }

    public function headings(): array
    {
        return [
            'Kategori',
            'Nama Produk',
            'Jumlah Terjual',
            'Subtotal',
        ];
    }

    public function collection()
    {
        $dataPizza = DB::table('detail_pesanans')
            ->join('pizzas', 'detail_pesanans.pizza_id', '=', 'pizzas.id')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.created_at', 'like', $this->bulan . '%')
            ->select(
                'pizzas.id as pizza_id',
                'pizzas.nama_pizza as nama',
                DB::raw('SUM(detail_pesanans.jumlah) as jumlah'),
                DB::raw('SUM(detail_pesanans.subtotal) as subtotal')
            )
            ->groupBy('pizzas.id', 'pizzas.nama_pizza')
            ->get();
    
        $dataPizzaDetail = DB::table('pizza_rasa_detail_pesanans')
            ->join('detail_pesanans', 'pizza_rasa_detail_pesanans.detail_pesanan_id', '=', 'detail_pesanans.id')
            ->join('rasa_pizzas', 'pizza_rasa_detail_pesanans.rasa_pizza_id', '=', 'rasa_pizzas.id')
            ->join('pizzas', 'detail_pesanans.pizza_id', '=', 'pizzas.id')
            ->join('pesanans', 'detail_pesanans.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.created_at', 'like', $this->bulan . '%')
            ->select(
                'pizzas.id as pizza_id',
                'rasa_pizzas.nama_rasa',
                DB::raw('SUM(detail_pesanans.jumlah) as jumlah'),
                DB::raw('SUM(detail_pesanans.subtotal) as subtotal')
            )
            ->groupBy('pizzas.id', 'rasa_pizzas.nama_rasa')
            ->get()
            ->groupBy('pizza_id');
    
        $dataMakananLain = DB::table('detail_makanan_lains')
            ->join('makanan_lains', 'detail_makanan_lains.makanan_lain_id', '=', 'makanan_lains.id')
            ->join('pesanans', 'detail_makanan_lains.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.created_at', 'like', $this->bulan . '%')
            ->select(
                'makanan_lains.nama_makanan as nama',
                DB::raw('SUM(detail_makanan_lains.jumlah) as jumlah'),
                DB::raw('SUM(detail_makanan_lains.subtotal) as subtotal')
            )
            ->groupBy('makanan_lains.nama_makanan')
            ->get();
    
        $dataPizzaPanjang = DB::table('detail_pizza_panjangs')
            ->join('pizza_panjangs', 'detail_pizza_panjangs.pizza_panjang_id', '=', 'pizza_panjangs.id')
            ->join('pesanans', 'detail_pizza_panjangs.pesanan_id', '=', 'pesanans.id')
            ->where('pesanans.created_at', 'like', $this->bulan . '%')
            ->select(
                'pizza_panjangs.nama_pizza as nama',
                DB::raw('SUM(detail_pizza_panjangs.jumlah) as jumlah'),
                DB::raw('SUM(detail_pizza_panjangs.subtotal) as subtotal')
            )
            ->groupBy('pizza_panjangs.nama_pizza')
            ->get();
    
        $formatted = collect();
    
        // === Pizza ===
        $firstPizza = true;
        $totalPizzaJumlah = 0;
$totalPizzaSubtotal = 0;

foreach ($dataPizza as $pizza) {
    $formatted->push([
        $firstPizza ? 'Pizza' : '',
        $pizza->nama,
        $pizza->jumlah,
        $pizza->subtotal,
    ]);
    $firstPizza = false;

    $totalPizzaJumlah += $pizza->jumlah;
    $totalPizzaSubtotal += $pizza->subtotal;

    if ($dataPizzaDetail->has($pizza->pizza_id)) {
        foreach ($dataPizzaDetail[$pizza->pizza_id] as $rasa) {
            $formatted->push([
                '',
                '- ' . $rasa->nama_rasa,
                $rasa->jumlah,
                '-',
            ]);
        }
    }
}

$formatted->push([
    '',
    'Total Pizza',
    $totalPizzaJumlah,
    $totalPizzaSubtotal,
]);

    
        // === Makanan Lain ===
        $totalMakananJumlah = 0;
        $totalMakananSubtotal = 0;
        $firstMakanan = true;
    
        foreach ($dataMakananLain as $item) {
            $formatted->push([
                $firstMakanan ? 'Makanan Lain' : '',
                $item->nama,
                $item->jumlah,
                $item->subtotal,
            ]);
            $firstMakanan = false;
    
            $totalMakananJumlah += $item->jumlah;
            $totalMakananSubtotal += $item->subtotal;
        }
    
        $formatted->push([
            '',
            'Total Makanan Lain',
            $totalMakananJumlah,
            $totalMakananSubtotal,
        ]);
    
        // === Pizza Panjang ===
        $totalPanjangJumlah = 0;
        $totalPanjangSubtotal = 0;
        $firstPanjang = true;
    
        foreach ($dataPizzaPanjang as $item) {
            $formatted->push([
                $firstPanjang ? 'Pizza Panjang' : '',
                $item->nama,
                $item->jumlah,
                $item->subtotal,
            ]);
            $firstPanjang = false;
    
            $totalPanjangJumlah += $item->jumlah;
            $totalPanjangSubtotal += $item->subtotal;
        }
    
        $formatted->push([
            '',
            'Total Pizza Panjang',
            $totalPanjangJumlah,
            $totalPanjangSubtotal,
        ]);
    
        // === Grand Total ===
        $grandTotalJumlah = $formatted->filter(function ($row) {
            return is_numeric($row[2]);
        })->sum(function ($row) {
            return (float) $row[2];
        });
    
        $grandTotalSubtotal = $formatted->filter(function ($row) {
            return is_numeric($row[3]);
        })->sum(function ($row) {
            return (float) $row[3];
        });
    
        $formatted->push([
            '',
            'Grand Total',
            $grandTotalJumlah,
            $grandTotalSubtotal,
        ]);
    
        return $formatted;
    }
    

    public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            $sheet = $event->sheet;

            // === Sisipkan baris untuk judul laporan ===
            $sheet->insertNewRowBefore(1, 1); // <--- Tambahan penting ini

            $sheet->mergeCells('A1:D1');
            $sheet->setCellValue('A1', 'LAPORAN PENJUALAN PIZZAKY ' . $this->bulan);
            $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A1')->getAlignment()->setVertical('center');
        
            // === Header (pindah ke baris 2) ===
            $sheet->getStyle('A2:D2')->applyFromArray([
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFFFFF99'], // Kuning muda
                ],
            ]);
            $sheet->getStyle("A2:D2")->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
            $sheet->getStyle("A2:D2")->getAlignment()->setVertical(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            );
        
            $highestRow = $sheet->getHighestRow();
        
            // === Bold & highlight baris Total ===
            for ($row = 3; $row <= $highestRow; $row++) {
                $value = $sheet->getCell("B{$row}")->getValue();
        
                if (str_contains($value, 'Total')) {
                    if ($value === 'Grand Total') {
                        // Apply bold and highlight for Grand Total
                        $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
                            'font' => ['bold' => true],
                            'fill' => [
                                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                                'startColor' => ['argb' => 'FFFFC0CB'], // Pink muda
                            ],
                        ]);
                    } else {
                        // Do not apply bold for other total rows (Pizza, Makanan Lain, Pizza Panjang)
                        $sheet->getStyle("A{$row}:D{$row}")->applyFromArray([
                            'font' => ['bold' => false],
                        ]);
                    }
                }
            }
        
            // === Border untuk semua sel ===
            $sheet->getStyle("A2:D{$highestRow}")->getBorders()->getAllBorders()
                ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
        
            // === Bold + center vertikal kategori utama (kolom A) ===
            $kategoriRowStart = [];
            for ($row = 3; $row <= $highestRow; $row++) {
                $kategori = $sheet->getCell("A{$row}")->getValue();
                if (!empty($kategori) && !isset($kategoriRowStart[$kategori])) {
                    $kategoriRowStart[$kategori] = $row;
                }
            }

            // Loop untuk mengatur bold hanya kategori selain Total Pizza, Makanan Lain, dan Pizza Panjang
            foreach ($kategoriRowStart as $row) {
                $kategori = $sheet->getCell("A{$row}")->getValue();
                if (in_array($kategori, ['Total Pizza', 'Total Makanan Lain', 'Total Pizza Panjang'])) {
                    $sheet->getStyle("A{$row}")->getFont()->setBold(false); // Tidak bold untuk kategori ini
                } else {
                    $sheet->getStyle("A{$row}")->getFont()->setBold(true); // Bold untuk kategori lainnya
                }
                $sheet->getStyle("A{$row}")->getAlignment()->setVertical(
                    \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
                );
            }

            // === Auto width kolom ===
            foreach (range('A', 'D') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }
        
            // === Format kolom harga ke rupiah ===
            $currencyStyle = [
                'numberFormat' => [
                    'formatCode' => '"Rp" #,##0',
                ],
            ];
            $sheet->getStyle("D3:D{$highestRow}")->applyFromArray($currencyStyle);
        
            // === Tambahkan logic untuk pemindahan Total ke kolom A dan B ===
            for ($row = 2; $row <= $highestRow; $row++) {
                $value = $sheet->getCell("B{$row}")->getValue();
        
                // Merge & pindahkan Total ke kolom A jika termasuk total biasa
                if (in_array($value, ['Total Pizza', 'Total Makanan Lain', 'Total Pizza Panjang', 'Grand Total'])) {
        
                    // Pindahkan ke kolom A dan kosongkan B
                    $sheet->setCellValue("A{$row}", $value);
                    $sheet->setCellValue("B{$row}", '');
        
                    // Merge A dan B
                    $sheet->mergeCells("A{$row}:B{$row}");
        
                    // Styling
                    $styleArray = [
                        'font' => ['bold' => true],
                        'alignment' => [
                            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                        ],
                    ];
        
                    // Tambah background khusus untuk Grand Total
                    if ($value === 'Grand Total') {
                        $styleArray['fill'] = [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['argb' => 'FFFFC0CB'], // Pink muda
                        ];
                    }
        
                    $sheet->getStyle("A{$row}:D{$row}")->applyFromArray($styleArray);
        
                    // Rata tengah untuk kolom D (harga subtotal)
                    $sheet->getStyle("D{$row}")->getAlignment()->setHorizontal(
                        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
                    );
                }
            }

            // === Rata kiri untuk kolom A ===
            $sheet->getStyle("A3:A{$highestRow}")->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT
            );
        
            // === Rata tengah untuk kolom C ===
            $sheet->getStyle("C3:C{$highestRow}")->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            );
        
            // === Rata kanan untuk kolom D ===
            $sheet->getStyle("D3:D{$highestRow}")->getAlignment()->setHorizontal(
                \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT
            );
        },
    ];
}
    
}

