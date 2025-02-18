<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;

class SupplierForm extends Form
{
    public ?Supplier $supplier = null;

    public $nama = '';
    public $telepon = '';
    public $alamat = '';
    public $keterangan = '';

    public function rules()
    {
        return [
            'nama' => 'required',
            'telepon' => [
                'required',
                Rule::unique('supplier', 'telepon')->ignore($this->component->supplier)
            ],
            'alamat' => 'required',
        ];
    }

    protected $messages = [
        'nama.required' => 'Nama wajib diisi',
        'telepon.required' => 'Nomor telepon wajib diisi',
        'telepon.unique' => 'Nomor telepon sudah digunakan',
        'alamat.required' => 'Alamat wajib diisi',
    ];

    public function tambahSupplier(Supplier $supplier)
    {
        $this->supplier = $supplier;
        $this->nama = $supplier->nama;
        $this->telepon = $supplier->telepon;
        $this->alamat = $supplier->alamat;
        $this->keterangan = $supplier->keterangan;
    }

    public function tambahData()
    {
        $this->validate();

        if(!$this->supplier) {
            Supplier::create(
                $this->only(['nama', 'telepon', 'alamat', 'keterangan'])
            );
            flash()->success('Data berhasil ditambah');
        } else {
            $this->supplier->update($this->only(['nama', 'telepon', 'alamat', 'keterangan']));
            flash()->success('Data berhasil diubah');
        }
        $this->reset();
    }
}
