<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use Livewire\Component;
use App\Models\StokKeluar;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class StokKeluarForm extends Form
{
    public ?StokKeluar $stokKeluar = null;

    public $tanggal = '';
    public $produk = '';
    public $jumlah = '';
    public $keterangan = '';

    public function rules() {
        return [
            'produk' => 'required|exists:produk,id',
            'jumlah' => 'required|numeric',
            'keterangan' => 'required',
        ];
    }

    protected $messages = [
        'produk.required' => 'Produk wajib diisi',  
        'produk.exists' => 'Produk tidak ditemukan',
        'jumlah.required' => 'Jumlah wajib diisi',
        'jumlah.numeric' => 'Jumlah harus berupa angka',
        'keterangan.required' => 'Keterangan wajib diisi',
    ];

    public function tambahStokKeluar(StokKeluar $stokKeluar) {
        $this->stokKeluar = $stokKeluar;

        $this->tanggal = $stokKeluar->tanggal;
        $this->produk = $stokKeluar->barcode_id;
        $this->jumlah = $stokKeluar->jumlah;
        $this->keterangan = $stokKeluar->keterangan;
    }

    public function tambahData() {
        $this->validate();

        if (!$this->stokKeluar) {
            StokKeluar::create([
                'tanggal' => Carbon::parse($this->tanggal)->format('Y-m-d'), // Carbon::parse() untuk membuat instance objek tanggal dari string
                'barcode_id' => $this->produk,
                'jumlah' => $this->jumlah,
                'keterangan' => $this->keterangan,
            ]);
            flash()->success('Stok Keluar berhasil ditambahkan');
        } else {
            $this->stokKeluar->update([
                'tanggal' => $this->tanggal,
                'barcode_id' => $this->produk,
                'jumlah' => $this->jumlah,
                'keterangan' => $this->keterangan,
            ]);
            flash()->success('Stok Keluar berhasil diubah');
        }

        $this->reset();
    }

    public function render()
    {
        return view('livewire.forms.stok-keluar-form');
    }
}
