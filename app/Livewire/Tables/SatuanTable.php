<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SatuanProduk;
use Livewire\WithPagination;

class SatuanTable extends Component
{
    use WithPagination;

    public $search;



    public function updatingSearch() {
        $this->resetPage();
    }

    #[On('refresh')]
    public function refresh() {}


    public function render()
    {
        return view('livewire.tables.satuan-table', [
            'satuan' => SatuanProduk::getDataSatuan($this->search)
        ]);
    }
}
