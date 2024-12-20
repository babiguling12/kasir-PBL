<?php

namespace App\Livewire\Modals;

use Livewire\Component;
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
            'stok_masuk' => StokMasuk::select('barcode_id', 'supplier_id')->get(),
        ]);
    }
}
