<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SatuanProduk extends Model
{
    protected $table = 'satuan_produk';
    protected $fillable = ['satuan'];

    public function produk(): HasMany {
        return $this->hasMany(Produk::class, 'satuan_id');
    }
}
