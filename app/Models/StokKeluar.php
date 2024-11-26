<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StokKeluar extends Model
{
    protected $table = 'stok_keluar';

    protected $fillable = [
        'tanggal',
        'barcode',
        'jumlah',
        'keterangan',
    ];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class);
    }
}
