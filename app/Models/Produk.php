<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function transaksi_detail(): HasMany {
        return $this->hasMany(TransaksiDetail::class, 'barcode');
    }

    public function satuan(): BelongsTo {
        return $this->belongsTo(SatuanProduk::class);
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriProduk::class);
    }

    public function stok_keluar(): HasMany {
        return $this->hasMany(StokKeluar::class, 'barcode');
    }

    public function stok_masuk(): HasMany {
        return $this->hasMany(StokMasuk::class, 'barcode');
    }
}