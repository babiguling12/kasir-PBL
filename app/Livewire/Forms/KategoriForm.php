<?php

namespace App\Livewire\Forms;

use App\Models\KategoriProduk;
use Livewire\Form;
use Livewire\Component;

class KategoriForm extends Form
{
    public ?KategoriProduk $kategoriProduk = null;

    public $kategori = null;

    public function rules() {
        return [
            'kategori' => 'required|max:100',
        ];
    }

    protected $messages = [
        'kategori.required' => 'Kategori harus diisi',
        'kategori.max' => 'Kategori maksimal 100 karakter',
    ];

    public function tambahKategori(KategoriProduk $kategoriProduk) {
        $this->kategoriProduk = $kategoriProduk;
        $this->kategori = $kategoriProduk->nama_kategori;
    }

    public function tambahData() {
        $this->validate();

        if (!$this->kategoriProduk) {
            KategoriProduk::create([
                'nama_kategori' => $this->kategori,
            ]);
            flash()->success('Kategori berhasil ditambahkan');
        } else {
            $this->kategoriProduk->update([
                'nama_kategori' => $this->kategori,
            ]);
            flash()->success('Kategori berhasil diubah');
        } 

        $this->reset();
    }

}
