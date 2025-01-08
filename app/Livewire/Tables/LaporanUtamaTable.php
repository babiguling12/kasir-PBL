<?php

namespace App\Livewire\Tables;


use App\Models\Produk;
use Livewire\Component;
use App\Models\Pengguna;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use App\Models\StokKeluar;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;
use App\Models\TransaksiDetail;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanUtamaTable extends Component
{
    use WithPagination;

    public $startDate, $endDate;

    public function mount()
    {
        
        $this->endDate = $this->endDate ?: Carbon::today()->toDateString(); // Format it as 'YYYY-MM-DD'
    }
    protected $queryString = ['startDate', 'endDate'];

    #[On('refresh')]
    public function refresh() {}
    
    public function updated($propertyName)
    {
        if ($propertyName == 'startDate' || $propertyName == 'endDate') {
            $this->dispatch('refreshData',$this->startDate, $this->endDate); 
        }
    }

    public function render()
    {
        $transaksi=Transaksi::getDataTransaksi($this->startDate,$this->endDate);
        $transaksi->load('transaksi_detail');
        $produk_terjual = $transaksi->pluck('transaksi_detail')->flatten()->sum('qty');
        
        return view('livewire.tables.laporan-utama-table', [
            'startDate'=>$this->startDate,
            'endDate'=>$this->endDate,
            'transaksi'=>$transaksi,
            'stok' => StokMasuk::getStokMasuk($this->startDate,$this->endDate),
            'produk_terjual' => $produk_terjual
        ]);
    }





    public function export()
{
    //LOAD SEMUA DATA KARENA BODO AMAT
    $transaksi=Transaksi::getDataTransaksi($this->startDate,$this->endDate);
    $transaksi->load('transaksi_detail');
    $produk_terjual = $transaksi->pluck('transaksi_detail')->flatten();
    $products = Produk::all();
    $stokmasuk = StokMasuk::getStokMasuk($this->startDate,$this->endDate);
    $stokkeluar = StokKeluar::getStokKeluar($this->startDate,$this->endDate);
    $users = Pengguna::all();

    // Buat objek spreadsheet baru
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Sheet 1: Laporan Produk
    $sheet->setTitle('Laporan Produk');
    $sheet->setCellValue('A1', 'Laporan Keseluruhan Edipos');
    $sheet->mergeCells('A1:H1');
    $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

    // Header tanggal
    $startDate = $this->startDate;
    $endDate = $this->endDate;
    $dateHeader = $startDate && $endDate
        ? "Dari tanggal $startDate sampai $endDate"
        : ($startDate ? "Dari tanggal $startDate" : "Sampai tanggal $endDate");
    $sheet->setCellValue('A2', $dateHeader);
    $sheet->mergeCells('A2:H2');
    $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

    $data = [
        ['Produk', 'Barcode', 'Satuan', 'Kategori', 'Stok Masuk', 'Stok Keluar', 'Terjual', 'Revenue']
    ];

    // Set header style
    $headerStyle = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']], // White text color
        'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'ADD8E6']], // Light blue background
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK],
            'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK]
        ]
    ];
    
    // Data rows style
    $dataRowStyle = [
        'font' => ['color' => ['rgb' => '000000']], // Black text color
        'borders' => [
            'top' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'bottom' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'left' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],
            'right' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN]
        ]
    ];

    foreach ($products as $produk) {
        $terjual = $produk_terjual->where('barcode_id', $produk->id)->sum('qty');
        $stokMasuk = $stokmasuk->where('barcode_id', $produk->id)->sum('total_stokmasuk');
        $stokKeluar = $stokkeluar->where('barcode_id', $produk->id)->sum('jumlah');
        $revenue = $produk->harga * $terjual;
        $formattedRevenue = 'Rp ' . number_format($revenue, 0, ',', '.');
        
        // Add row data
        $data[] = [
            $produk->nama_produk,
            "'".$produk->barcode,
            $produk->satuan->nama_satuan,
            $produk->kategori->nama_kategori,
            $stokMasuk,
            $stokKeluar,
            $terjual,
            $formattedRevenue
        ];
    }
    // Add the data to the sheet and apply data row style
    $sheet->fromArray($data, null, 'A4');
    $sheet->getStyle('A4:H' . (count($data) + 3))->applyFromArray($dataRowStyle);
    $sheet->getStyle('A4:H4')->applyFromArray($headerStyle);
    

    // Tambahkan Sheet 2: Laporan Kasir
    $spreadsheet->createSheet();
    $spreadsheet->setActiveSheetIndex(1);
    $sheet2 = $spreadsheet->getActiveSheet();
    $sheet2->setTitle('Laporan Kasir');
    $sheet2->setCellValue('A1', 'Laporan Keseluruhan Edipos');
    $sheet2->mergeCells('A1:C1');
    $sheet2->getStyle('A1')->getAlignment()->setHorizontal('center');

    $sheet2->setCellValue('A2', $dateHeader);
    $sheet2->mergeCells('A2:C2');
    $sheet2->getStyle('A2')->getAlignment()->setHorizontal('center');

    $data2 = [
        ['Username', 'Nama', 'Total Transaksi'], 
    ];

    foreach($users as $pengguna){
        $tot_trans=$transaksi->where('kasir_id', $pengguna->id)->count();
        $data2[] = [
            $pengguna->username,
            $pengguna->nama,
            $tot_trans
        ];
    }

    $sheet2->fromArray($data2, null, 'A4');
    $sheet2->getStyle('A4:C' . (count($data2) + 3))->applyFromArray($dataRowStyle);
    $sheet2->getStyle('A4:C4')->applyFromArray($headerStyle);

    // Simpan file Excel dan unduh
    $fileName = 'Laporan_Keseluruhan_Edipos.xlsx';

    // Return the Excel file as a response stream
    return response()->stream(function () use ($spreadsheet) {
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
    }, 200, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'Content-Disposition' => 'attachment;filename="Laporan_Keseluruhan_Edipos.xlsx"',
        'Cache-Control' => 'max-age=0',
    ]);
}
}
