<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class AllProdukForm extends Form
{
    use WithFileUploads;

    public ?Produk $produk = null;

    public $nama = '';
    public $barcode = '';
    public $kategori = '';
    public $satuan = '';
    public $harga = '';
    public $stok='0';
    public $terjual='0';
    public $foto;
    

    public function rules() {
        $uniqueBarcodeRule = $this->produk ?
            'required|digits:13|numeric|unique:produk,barcode,' . $this->produk->id
            : 'required|digits:13|numeric|unique:produk,barcode';

        return [
            'nama' => 'required|max: 100',
            'barcode' => $uniqueBarcodeRule,
            'kategori' => 'required|exists:kategori_produk,id',
            'satuan' => 'required|exists:satuan_produk,id',
            'harga' => 'required',
            'foto' => $this->produk ? 'nullable|image|mimes:jpeg,jpg,png|max:2048' : 'required|image|mimes:jpeg,jpg,png|max:2048',
        ];
    }

    protected $messages = [
        'nama.required' => 'Nama produk harus diisi',
        'nama.max' => 'Nama produk tidak boleh lebih dari 100 karakter',
        'barcode.required' => 'Barcode produk harus diisi',
        'barcode.digits' => 'Barcode produk harus 13 karakter',
        'barcode.unique' => 'Barcode produk sudah ada',
        'barcode.numeric' => 'Barcode produk harus angka',
        'kategori.required' => 'Kategori produk harus diisi',
        'kategori.exists' => 'Kategori produk tidak ditemukan',
        'satuan.required' => 'Satuan produk harus diisi',
        'satuan.exists' => 'Satuan produk tidak ditemukan',
        'harga.required' => 'Harga produk harus diisi',
        'foto.required' => 'Foto produk harus diisi',
        'foto.image' => 'Foto produk harus berupa gambar',
        'foto.mimes' => 'Foto produk harus berupa JPEG, JPG, atau PNG',
        'foto.max' => 'Foto produk tidak boleh lebih besar dari 2MB',
    ];

    public function tambahProduk(Produk $produk) {
        $this->produk = $produk;

        $this->nama = $produk->nama_produk;
        $this->barcode = $produk->barcode;
        $this->kategori = $produk->kategori_id;
        $this->satuan = $produk->satuan_id;
        $this->harga = $produk->harga;
        $this->stok = $produk->stok;
        $this->terjual = $produk->terjual;
        $this->foto = $produk->foto;
    }

    public function tambahData() {
        $this->validate();

        if($this->foto) {
            $originalFileName = $this->foto->getClientOriginalName();
            $uniqueFileName = uniqid() . '-' . $originalFileName;
            $storeFilePath = $this->foto->storeAs('img/produk', $uniqueFileName, 'public'); // disimpan di folder storage/app/public
        }

        if (!$this->produk) {
            Produk::create([
                'nama_produk' => $this->nama,
                'barcode' => $this->barcode,
                'kategori_id' => $this->kategori,
                'satuan_id' => $this->satuan,
                'harga' => $this->harga,
                'stok' => $this->stok,
                'terjual' => $this->terjual,
                'foto' => $storeFilePath ?? null,
            ]);
            flash()->success('Produk berhasil ditambahkan');
        } else {

            if($this->foto && $this->produk->foto) {
                if (Storage::disk('public')->exists($this->produk->foto)) {
                    Storage::disk('public')->delete($this->produk->foto);
                }

                $this->produk->update([
                    'nama_produk' => $this->nama,
                    'barcode' => $this->barcode,
                    'kategori_id' => $this->kategori,
                    'satuan_id' => $this->satuan,
                    'harga' => $this->harga,
                    'stok' => $this->stok,
                    'terjual' => $this->terjual,
                    'foto' => $storeFilePath ?? $this->produk->foto,
                ]);
                flash()->success('Produk berhasil diubah');
            }

        }
        $this->reset();
    }

}
