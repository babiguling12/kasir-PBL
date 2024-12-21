<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use App\Models\StokKeluar;
use LivewireUI\Modal\ModalComponent;
use App\Livewire\Forms\StokKeluarForm;

class StokKeluarModal extends ModalComponent
{
    public ?StokKeluar $stokKeluar = null;

    public StokKeluarForm $form;

    public function mount() {
        if($this->stokKeluar && $this->stokKeluar->exists) {
            $this->form->tambahStokKeluar($this->stokKeluar);
        }
    }

    public function save() {
        $this->form->tambahData();

        $this->closeModal();
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.forms.stok-keluar-form', [
            'stok_keluar' => StokKeluar::select('barcode_id')->get(),
        ]);
    }
}
