<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\SatuanProduk;
Use Iluminate\Validation\Rule;

class SatuanForm extends Form
{
    public ?SatuanProduk $satuanProduk = null;

    public $satuan = '';

    public function rules() {
        return [
            'satuan' => 'required|max: 100',
        ];
    }

    public function tambahSatuan(SatuanProduk $satuanProduk) {
        $this->satuanProduk = $satuanProduk;
        $this->satuan = $satuanProduk->nama_satuan;
    }

    public function tambahData() {
        $this->validate();

        if (!$this->satuanProduk) {
            SatuanProduk::create([
                'nama_satuan' => $this->satuan,
            ]);
            flash()->success('Satuan berhasil ditambahkan');
        } else {
            $this->satuanProduk->update([
                'nama_satuan' => $this->satuan,
            ]);
            flash()->success('Satuan berhasil diubah');
        }
        $this->reset();
    }
}
