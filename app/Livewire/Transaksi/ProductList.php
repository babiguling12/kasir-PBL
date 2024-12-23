<?php

namespace App\Livewire\Transaksi;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

class ProductList extends Component
{
    use WithPagination;

    public $search;
    public $kategori;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function pilihProduk($product)
    {
        $this->dispatch('tambahProduk', $product);
    }

    public function render()
    {
        $products = ($this->kategori > 0) ?
        Produk::where('nama_produk', 'like', '%' . $this->search . '%')->where('kategori_id', '=', $this->kategori)->latest()->paginate(10):
        Produk::where('nama_produk', 'like', '%' . $this->search . '%')->latest()->paginate(10);

        return view('livewire.transaksi.product-list', [
            'categories' => KategoriProduk::all(),
            'products' => $products,
        ]);
    }
}
