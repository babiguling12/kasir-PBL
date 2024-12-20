<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Component;
use App\Models\StokMasuk;

class StokMasukForm extends Form
{
    public ?StokMasuk $stokMasuk = null;

    public $tanggal = '';
    public $produk = '';
    public $jumlah = '';
    public $keterangan = '';
    public $supplier = '';

    public function rules() {
        return [
            'tanggal' => 'required',
            'produk' => 'required|exists:Produk,id',
            'jumlah' => 'required',
            'supplier' => 'required|exists:Supplier,id',
        ];
    }

    public function tambahStokMasuk(StokMasuk $stokMasuk) {
        $this->stokMasuk = $stokMasuk;

        $this->tanggal = $stokMasuk->tanggal;
        $this->produk = $stokMasuk->barcode_id;
        $this->jumlah = $stokMasuk->jumlah;
        $this->keterangan = $stokMasuk->keterangan;
        $this->supplier = $stokMasuk->supplier_id;
    }

    public function tambahData() {
        $this->validate();

        if (!$this->stokMasuk) {
            StokMasuk::create([
                'tanggal' => now()->format('Y-m-d'),
                'barcode_id' => $this->produk,
                'jumlah' => $this->jumlah,
                'keterangan' => $this->keterangan,
                'supplier_id' => $this->supplier,
            ]);
            flash()->success('Stok Masuk berhasil ditambahkan');
        } else {
            $this->stokMasuk->update([
                'tanggal' => $this->tanggal,
                'barcode_id' => $this->produk,
                'jumlah' => $this->jumlah,
                'keterangan' => $this->keterangan,
                'supplier_id' => $this->supplier,
            ]);
            flash()->success('Stok Masuk berhasil diubah');
        }

        $this->reset();
    }
}
