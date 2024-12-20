<?php

namespace App\Livewire\Modals;

use App\Models\Supplier;
use App\Livewire\Forms\SupplierForm;
use LivewireUI\Modal\ModalComponent;

class SupplierModal extends ModalComponent
{
    public ?Supplier $supplier = null;

    public SupplierForm $form;

    public function mount()
    {
        if($this->supplier && $this->supplier->exists) {
            $this->form->setSupplier($this->supplier);
        }
    }

    public function save()
    {
        $this->form->store();

        $this->closeModal();
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.forms.supplier-form');
    }
}
