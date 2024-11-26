<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Model
{
    use HasFactory;
    
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
