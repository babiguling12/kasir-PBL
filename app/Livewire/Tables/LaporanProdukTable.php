<?php

namespace App\Livewire\Tables;

use App\Models\Produk;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class LaporanProdukTable extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    public function updatingSearch() {

        $this->resetPage();
    }

    #[On('refresh')]
    public function refresh() {}


    public function render()
    {

        return view('livewire.tables.laporan-produk-table', [
            'products' => Produk::getDataProduk($this->search),
        ]);
    }
}
