<?php

namespace App\Livewire\Tables;

use App\Models\Produk;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class AllProdukTable extends Component
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
        return view('livewire.tables.all-produk-table', [
            'products' => Produk::getDataProduk($this->search)
        ]);
    }
}
