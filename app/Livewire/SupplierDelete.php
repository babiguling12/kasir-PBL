<?php

namespace App\Livewire;

use App\Models\Supplier;
use App\Livewire\Forms\SupplierForm;
use LivewireUI\Modal\ModalComponent;

class SupplierDelete extends ModalComponent
{
    public $supplier;

    public function mount(Supplier $supplier)
    {
        $this->supplier = $supplier;
    }

    public function destroy()
    {
        $this->supplier->delete();

        flash()->success('Data berhasil dihapus');

        $this->closeModal();
        $this->dispatch('supplier-refresh');
    }

    public function render()
    {
        return view('livewire.delete-modal');
    }

    public static function modalMaxWidth(): string
{
    return 'md';
}
}
