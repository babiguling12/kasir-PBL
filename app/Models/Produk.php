<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = ['id', 'barcode'];
    protected $fillable = [
        'barcode',
        'nama_produk',
        'kategori',
        'satuan_produk',
        'harga',
        'stok',
        'terjual',
    ];
}
