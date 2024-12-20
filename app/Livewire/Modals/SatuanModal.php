<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use App\Models\SatuanProduk;
use App\Livewire\Forms\SatuanForm;
use LivewireUI\Modal\ModalComponent;

class SatuanModal extends ModalComponent
{
    public ?SatuanProduk $satuanProduk = null;
     
    public SatuanForm $form;

    public function mount() {
        if($this->satuanProduk && $this->satuanProduk->exists) {
            $this->form->tambahSatuan($this->satuanProduk);
        }
    }

    public function save() {
        $this->form->tambahData();

        $this->closeModal();
        $this->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.forms.satuan-form');
    }
}
