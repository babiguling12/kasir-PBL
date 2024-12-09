<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokMasuk extends Model
{
    use HasFactory;
    
    protected $table = 'stok_masuk';

    protected $fillable = [
        'tanggal',
        'barcode_id',
        'supplier_id',
        'jumlah',
        'keterangan',
    ];

    protected $with = ['produk', 'supplier'];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class, 'barcode_id');
    }

    public function supplier(): BelongsTo {
        return $this->belongsTo(Supplier::class);
    }
}
