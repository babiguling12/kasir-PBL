<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Pengguna;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class LaporanKasirTable extends Component
{
    use WithPagination;

    public $startDate, $endDate, $search;

    protected $queryString = ['search', 'startDate', 'endDate'];


    public function updatingSearch() {
        
        $this->resetPage();
    }

    #[On('refresh')]
    public function refresh() {}

    protected $listeners = ['refreshData' => 'refresh_Data'];

    public function refresh_Data($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->resetPage();
    }

    public function render()
    {
        
        return view('livewire.tables.laporan-kasir-table', [
            'users' => Pengguna::getDataUser($this->search),
            'transaksi'=>Transaksi::getDataTransaksi($this->startDate,$this->endDate)
        ]);
    }
}
