<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\StokKeluar;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class StokKeluarTable extends Component
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
        return view('livewire.tables.stok-keluar-table', [
            'stok_keluar' => StokKeluar::getDataStokKeluar($this->search)
        ]);
    }
}
