<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\StokMasuk;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class StokMasukTable extends Component
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
        return view('livewire.tables.stok-masuk-table', [
            'stok_masuk' => StokMasuk::getDataStokMasuk($this->search)
        ]);
    }
}
