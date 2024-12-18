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

    public static function getYearlySales($year) {
        return self::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(total_bayar) as total_revenue, COUNT(id) as total_transaksi')
            ->whereYear('tanggal', $year)
            ->groupByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->orderBy('month', 'asc')
            ->get()
            ->keyBy('month'); // Optional: Key the result by month
    }

    public static function getTodaySales($currentDate) {
        return self::selectRaw('DATE(tanggal) as date, SUM(total_bayar) as total_revenue, COUNT(id) as total_transaksi')
            ->whereDate('tanggal', $currentDate) 
            ->groupByRaw('DATE(tanggal)') 
            ->orderBy('date', 'asc')
            ->get();
    }
}

