<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Transaksi;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class AllHistoriTable extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    #[On('refresh')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.tables.all-histori-table', [
            'histori' => Transaksi::getRiwayat($this->search)
        ]);
    }
}
