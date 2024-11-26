<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;
    
    protected $table = 'supplier';
    protected $fillable = [
        'nama',
        'alamat',
        'telepon',
        'keterangan',
    ];

    public function stok_masuk(): HasMany {
        return $this->hasMany(StokMasuk::class);
    }
}
