<?php

namespace App\Livewire\Transaksi;

use App\Models\Transaksi;
use LivewireUI\Modal\ModalComponent;

class KonfirmasiTransaksi extends ModalComponent
{
    public $print;

    public function confirm()
    {
        $this->dispatch('transaksiDikonfirmasi');
        $this->closeModal();
    }

    public function printstruk()
    {
        $this->closeModal();
        return to_route('page.transaksi.detail', ['id' => Transaksi::latest()->first()->id]);
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    public function render()
    {
        if ($this->print === false) {
            return view('livewire.transaksi.konfirmasi-transaksi');
        }
        else {
            return view('livewire.transaksi.print-transaksi');
        }
    }
}
