<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class SupplierTable extends Component
{
    use WithPagination;

    public $search;



    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('refresh')]
    public function refresh() {}

    public function render()
    {
        return view('livewire.tables.supplier-table', [
            'suppliers' => Supplier::getDataSupplier($this->search)
        ]);
    }
}
