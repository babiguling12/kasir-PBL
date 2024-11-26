<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriProduk extends Model
{
    protected $table = 'kategori_produk';

    protected $fillable = [
        'kategori',
    ];

    public function produk(): HasMany {
        return $this->hasMany(Produk::class, 'kategori_id');
    }
}
