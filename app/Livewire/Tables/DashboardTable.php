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

    public $filter='All Time';
    public $startDate;
   

    #[On('refresh')]
    public function refresh() {}

    public function filterData($filter)
    {
        switch ($filter) {
            case 'thisMonth':
                $this->startDate = now()->startOfMonth()->toDateString();
                $this->filter = 'Bulan ini';
                break;

            case 'thisYear':
                $this->startDate = now()->startOfYear()->toDateString();
                $this->filter = 'Tahun ini';
                break;

            case 'allTime':
            default:
                $this->startDate = null;
                $this->filter = 'All Time';
                break;
        }
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

        if($this->startDate){
            $trans_id = Transaksi::whereBetween('tanggal', [$this->startDate, now()])
            ->get();
            
            $salesData = TransaksiDetail::join('produk', 'produk.id', '=', 'transaksi_detail.barcode_id')
            ->whereIn('transaksi_detail.transaksi_id', $trans_id->pluck('id'))
            ->selectRaw('produk.nama_produk, SUM(transaksi_detail.qty) as terjual')
            ->groupBy('produk.id')
            ->get();

        }else{
             $salesData = TransaksiDetail::join('produk', 'produk.id', '=', 'transaksi_detail.barcode_id')
            ->selectRaw('produk.nama_produk, SUM(transaksi_detail.qty) as terjual')
            ->groupBy('produk.id')
            ->get();
        }
       
        $this->dispatch('filter-changed', salesData: $salesData);

        return view('livewire.tables.dashboard-table', [
            'filter'=>$this->filter,
            'thisYearSales' => $thisYearSales, 
            'lastYearSales' => $lastYearSales,
            'transaksi' => $transaksi,
            'stokMasuk' => $stokMasuk,
        ]);
    }
}


