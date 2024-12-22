<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Component;
use App\Models\StokMasuk;
use Illuminate\Support\Carbon;

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
            'produk' => 'required|exists:produk,id',
            'jumlah' => 'required|numeric',
            'supplier' => 'required|exists:supplier,id',
            'keterangan' => 'required',
        ];
    }

    protected $messages = [
        'produk.required' => 'Produk wajib diisi',
        'produk.exists' => 'Produk tidak ditemukan',
        'jumlah.required' => 'Jumlah wajib diisi',
        'jumlah.numeric' => 'Jumlah harus berupa angka',
        'supplier.required' => 'Supplier wajib diisi',
        'supplier.exists' => 'Supplier tidak ditemukan',
        'keterangan.required' => 'Keterangan wajib diisi',
    ];

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
                'tanggal' => Carbon::parse($this->tanggal)->format('Y-m-d'), // Carbon::parse()->format() untuk mengkonversi date ke format yang diinginkan
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
