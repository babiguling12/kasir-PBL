<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokKeluar extends Model
{
    use HasFactory;
    
    protected $table = 'stok_keluar';

    protected $fillable = [
        'tanggal',
        'barcode_id',
        'jumlah',
        'keterangan',
    ];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class);
    }
}
