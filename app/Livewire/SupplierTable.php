<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SupplierTable extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('refresh')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.supplier-table', [
            'suppliers' => Supplier::getDataSupplier($this->search)
        ]);
    }
}
