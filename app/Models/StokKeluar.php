<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StokKeluar extends Model
{
    protected $table = 'stok_keluar';

    protected $fillable = [
        'tanggal',
        'barcode',
        'jumlah',
        'keterangan',
    ];
}
