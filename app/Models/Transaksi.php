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
        'kasir_id',
    ];

    public function kasir(): BelongsTo {
        return $this->belongsTo(Pengguna::class);
    }

    public function transaksi_detail(): HasMany {
        return $this->hasMany(TransaksiDetail::class);
    }

    public static function getDataSales($dateType, $dateValue = null) {
        $query = self::selectRaw("
            {$dateType}(tanggal) as date_unit, 
            SUM(total_bayar) as total_revenue, 
            COUNT(id) as total_transaksi
        ")
        ->groupByRaw("{$dateType}(tanggal)")
        ->orderBy('date_unit', 'asc');
        
        if ($dateType === 'YEAR') {
            $query->whereYear('tanggal', $dateValue);
        } elseif ($dateType === 'DATE') {
            $query->whereDate('tanggal', $dateValue);
        }
    
        return $query->get()->keyBy('date_unit'); // Optional: Key the result by date_unit
    }
}

