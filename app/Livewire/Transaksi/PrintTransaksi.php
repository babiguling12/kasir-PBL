<?php

namespace App\Livewire\Transaksi;

use App\Models\Transaksi;
use LivewireUI\Modal\ModalComponent;

class PrintTransaksi extends ModalComponent
{

    public function confirm()
    {
        $this->closeModal();
        return to_route('page.transaksi.detail', ['id' => Transaksi::latest()->first()->id]);
    }

    public function render()
    {
        return view('livewire.transaksi.print-transaksi');
    }
}
