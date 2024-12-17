<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Supplier;
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

    public function render()
    {
        if($this->search == null) {
            $suppliers = Supplier::latest()->paginate(5);
        } else {
            $suppliers = Supplier::where('nama', 'like', '%'.$this->search.'%')->paginate(5);
        }

        return view('livewire.supplier-table', ['suppliers' => $suppliers]);
    }
}
