<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\SatuanProduk;
use Livewire\WithPagination;

class SatuanTable extends Component
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
        return view('livewire.satuan-table', [
            'satuan' => SatuanProduk::getDataSatuan($this->search)
        ]);
    }
}
