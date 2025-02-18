<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    
    protected $table = 'pengguna';

    protected $fillable = [
        'username',
        'nama',
        'password',
        'role',
        'foto',
    ];

    // public function transaksi(): HasMany {
    //     return $this->hasMany(Transaksi::class, 'kasir_id');
    // }

    public static function getDataUser($search) {
        return self::where('nama', 'like', '%' . $search . '%')->latest()->paginate(5);
    }
}
