<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SatuanProduk extends Model
{
    use HasFactory;
    
    protected $table = 'satuan_produk';
    protected $fillable = ['nama_satuan'];

    public function produk(): HasMany {
        return $this->hasMany(Produk::class, 'satuan_id');
    }

    public static function getDataSatuan($search) {
        return Self::where('nama_satuan', 'like', '%' . $search . '%')->latest()->paginate(5);
    }
    
}
