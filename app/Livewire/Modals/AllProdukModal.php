<?php

namespace App\Livewire\Modals;

use App\Models\Produk;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\AllProdukForm;

class AllProdukModal extends ModalComponent
{
    use WithFileUploads;

    public ?Produk $produk = null;

    public AllProdukForm $form;

    public function mount() {
        if($this->produk && $this->produk->exists) {
            $this->form->tambahProduk($this->produk);
        }
    }
    
    public function save() {
        $this->form->tambahData();

        $this->closeModal();
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.forms.all-produk-form', [
            'products' => Produk::select('kategori_id', 'satuan_id')->get(),
        ]);
    }
}
