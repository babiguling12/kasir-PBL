<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    
    protected $table = 'produk';
    protected $fillable = [
        'barcode',
        'nama_produk',
        'kategori_id',
        'satuan_id',
        'harga',
        'stok',
        'terjual',
        'foto',
    ];
    
    protected $with = ['satuan', 'kategori'];


    // public function transaksi_detail(): HasMany {
    //     return $this->hasMany(TransaksiDetail::class, 'barcode_id',);
    // }

    public function satuan(): BelongsTo {
        return $this->belongsTo(SatuanProduk::class);
    }

    public function kategori(): BelongsTo {
        return $this->belongsTo(KategoriProduk::class);
    }

    // public function stok_keluar(): HasMany {
    //     return $this->hasMany(StokKeluar::class, 'barcode_id');
    // }

    // public function stok_masuk(): HasMany {
    //     return $this->hasMany(StokMasuk::class, 'barcode_id');
    // }

    public static function getDataProduk($search) {
        return Self::where('nama_produk', 'like', '%'. $search . '%')
        ->orWhere('barcode', 'like', '%'. $search . '%')
        ->whereHas('kategori', fn($query) => $query->where('nama_kategori', 'like', '%' . $search . '%'))
        ->whereHas('satuan', fn($query) => $query->where('nama_satuan', 'like', '%' . $search . '%'))
        ->latest()->paginate(5);
    }
    
    public static function getProduk(){
        return self::all();
    }
}
