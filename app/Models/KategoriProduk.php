<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriProduk extends Model
{
    use HasFactory;
    
    protected $table = 'kategori_produk';

    protected $fillable = ['nama_kategori'];

    // public function produk(): HasMany {
    //     return $this->hasMany(Produk::class, 'kategori_id');
    // }

    public static function getDataKategori($search) {
        return Self::where('nama_kategori', 'like', '%' . $search . '%')->latest()->paginate(5);
    }
}
