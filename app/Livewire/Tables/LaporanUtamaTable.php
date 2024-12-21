<?php

namespace App\Livewire\Tables;


use Livewire\Component;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\TransaksiDetail;

class LaporanUtamaTable extends Component
{
    use WithPagination;

    public $startDate, $endDate;

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
}
