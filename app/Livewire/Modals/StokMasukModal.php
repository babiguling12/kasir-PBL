<?php

namespace App\Livewire\Modals;

use App\Models\Produk;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\StokMasuk;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\StokMasukForm;

class StokMasukModal extends ModalComponent
{
    public ?StokMasuk $stokMasuk = null;

    public StokMasukForm $form;

    public function mount() {
        if($this->stokMasuk && $this->stokMasuk->exists) {
            $this->form->tambahStokMasuk($this->stokMasuk);
        }
    }

    public function save() {
        $this->form->tambahData();

        $this->closeModal();
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.forms.stok-masuk-form', [
            'products' => Produk::all(),
            'suppliers' => Supplier::all(),
        ]);
    }
}
