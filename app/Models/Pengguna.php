<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    protected $fillable = [
        'username',
        'nama',
        'password',
        'role',
    ];

    public function transaksi(): HasMany {
        return $this->hasMany(Transaksi::class, 'kasir_id');
    }
}
