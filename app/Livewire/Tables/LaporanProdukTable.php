<?php

namespace App\Livewire\Tables;

use App\Models\Produk;
use Livewire\Component;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use App\Models\StokKeluar;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\TransaksiDetail;

class LaporanProdukTable extends Component
{
    use WithPagination;

    public $startDate, $endDate, $search;

    protected $queryString = ['startDate', 'endDate'];
    public function updatingSearch() {
        
        $this->resetPage();
    }

    #[On('refresh')]
    public function refresh() {}

    protected $listeners = ['refreshData'];

    public function refreshData($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->resetPage();
    }

    public function render()
    {

        $transaksi=Transaksi::getDataTransaksi($this->startDate,$this->endDate);
        $transaksi->load('transaksi_detail');
        $produk_terjual = $transaksi->pluck('transaksi_detail')->flatten();

        return view('livewire.tables.laporan-produk-table', [
            'products' => Produk::getDataProduk($this->search),
            'produk_terjual'=>$produk_terjual,
            'stokmasuk' => StokMasuk::getStokMasuk($this->startDate,$this->endDate),
            'stokkeluar' => StokKeluar::getStokKeluar($this->startDate,$this->endDate),
            
        ]);
    }
}
