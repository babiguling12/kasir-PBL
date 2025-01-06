<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\KategoriProduk;

class KategoriTable extends Component
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
        return view('livewire.tables.kategori-table', [
            'kategori' => KategoriProduk::getDataKategori($this->search)
        ]);
    }
}
