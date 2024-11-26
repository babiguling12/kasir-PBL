<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;
    
    protected $table = 'transaksi';
    protected $fillable = [
        'tanggal',
        'total_bayar',
        'jumlah_uang',
        'diskon',
        'nota',
        'kasir',
    ];

    public function kasir(): BelongsTo {
        return $this->belongsTo(Pengguna::class);
    }

    public function transaksi_detail(): HasMany {
        return $this->hasMany(TransaksiDetail::class);
    }
}
