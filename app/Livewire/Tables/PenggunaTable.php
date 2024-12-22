<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Pengguna;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PenggunaTable extends Component
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
        return view('livewire.tables.pengguna-table', [
            'users' => Pengguna::getDataUser($this->search)
        ]);
    }
}
