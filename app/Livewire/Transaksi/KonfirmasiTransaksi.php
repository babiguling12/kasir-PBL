<?php

namespace App\Livewire\Transaksi;

use LivewireUI\Modal\ModalComponent;

class KonfirmasiTransaksi extends ModalComponent
{
    public function confirm()
    {
        $this->dispatch('transaksiDikonfirmasi');
        $this->closeModal();
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        return view('livewire.transaksi.konfirmasi-transaksi');
    }
}
