<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransaksiDetail extends Model
{
    use HasFactory;

    protected $table = 'transaksi_detail';
    protected $fillable = [
        'transaksi_id',
        'qty',
        'harga_barang',
        'barcode_id',
    ];

    public function transaksi(): BelongsTo {
        return $this->belongsTo(Transaksi::class);
    }

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class);
    }


}
