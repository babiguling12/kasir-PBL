<?php

namespace App\Livewire\Modals;

use Livewire\Component;

use App\Models\KategoriProduk;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\KategoriForm;

class KategoriModal extends ModalComponent
{
    public ?KategoriProduk $kategoriProduk = null;

    public KategoriForm $form;

    public function mount() {
        if($this->kategoriProduk && $this->kategoriProduk->exists) {
            $this->form->tambahKategori($this->kategoriProduk);
        }
    }

    public function save() {
        $this->form->tambahData();

        $this->closeModal();
        $this->dispatch('refresh');
    }
    public function render()
    {
        return view('livewire.forms.kategori-form');
    }
}
