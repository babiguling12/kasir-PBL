<?php

namespace App\Livewire;

use App\Models\KategoriProduk;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

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
        return view('livewire.kategori-form');
    }
}
