<?php

namespace App\Livewire\Tables;

use App\Models\Produk;
use Livewire\Component;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\TransaksiDetail;

class DashboardTable extends Component
{

    use WithPagination;

    public $filter='Filter Data';
    public $startDate;
   

    #[On('refresh')]
    public function refresh() {}

    public function filterMonth()
    {
        $this->startDate = now()->startOfMonth()->toDateString();
        $this->filter = 'Bulan ini';
    
        $trans_id = Transaksi::whereBetween('tanggal', [$this->startDate, now()])
            ->get();
        $salesData = TransaksiDetail::join('produk', 'produk.id', '=', 'transaksi_detail.barcode_id')
            ->whereIn('transaksi_detail.transaksi_id', $trans_id->pluck('id'))
            ->selectRaw('produk.nama_produk, SUM(transaksi_detail.qty) as terjual')
            ->groupBy('produk.id')
            ->get();
    
        $this->dispatch('filter-changed', salesData: $salesData);
    }

    public function filterYear()
    {
        $this->startDate = now()->startOfYear()->toDateString();
        $this->filter = 'Tahun ini';

        $trans_id = Transaksi::whereBetween('tanggal', [$this->startDate, now()])
            ->get();
        $salesData = TransaksiDetail::join('produk', 'produk.id', '=', 'transaksi_detail.barcode_id')
            ->whereIn('transaksi_detail.transaksi_id', $trans_id->pluck('id'))
            ->selectRaw('produk.nama_produk, SUM(transaksi_detail.qty) as terjual')
            ->groupBy('produk.id')
            ->get();

        $this->dispatch('filter-changed', salesData: $salesData);
    }

    public function filterAll()
    {
        $this->startDate = null;
        $this->filter = 'All Time';

       
        $salesData = TransaksiDetail::join('produk', 'produk.id', '=', 'transaksi_detail.barcode_id')
            ->selectRaw('produk.nama_produk, SUM(transaksi_detail.qty) as terjual')
            ->groupBy('produk.id')
            ->get();

        $this->dispatch('filter-changed', salesData: $salesData);
    }


    public function render()
    {
        $currentYear = now()->year;
        $lastYear = $currentYear - 1;
        $currentDate = now()->toDateString();
        
        $lastYearSales = Transaksi::getDataSales($lastYear);
        $thisYearSales = Transaksi::getDataSales($currentYear);
        $transaksi = Transaksi::getDataTransaksi($currentDate);
        $stokMasuk = StokMasuk::getStokMasuk($currentDate);

        return view('livewire.tables.dashboard-table', [
            'filter'=>$this->filter,
            'thisYearSales' => $thisYearSales, 
            'lastYearSales' => $lastYearSales,
            'transaksi' => $transaksi,
            'stokMasuk' => $stokMasuk,
        ]);
    }
}


