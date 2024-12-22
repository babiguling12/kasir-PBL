<?php

namespace App\Livewire\Modals;

use Livewire\Component;
use App\Models\Pengguna;
use App\Livewire\Forms\PenggunaForm;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class PenggunaModal extends ModalComponent
{
    use WithFileUploads;
    
    public ?Pengguna $pengguna = null;

    public PenggunaForm $form;

    public function mount() {
        if($this->pengguna && $this->pengguna->exists) {
            $this->form->tambahPengguna($this->pengguna);
        }
    }

    public function save() {
        $this->form->tambahData();

        $this->closeModal();
        $this->dispatch('refresh');
    }

    public function render()
    {
        return view('livewire.forms.pengguna-form');
    }
}
