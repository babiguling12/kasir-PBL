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

    public static function getDataSales($dateValue = null) {
        $query = self::selectRaw("
            MONTH(tanggal) as month_unit, 
            SUM(total_bayar) as total_revenue, 
            COUNT(id) as total_transaksi
        ")
        ->groupByRaw("MONTH(tanggal)")
        ->orderBy('month_unit', 'asc');
    
        $query->whereYear('tanggal', $dateValue); 
    
        return $query->get()->keyBy('month_unit');
    }
    

    public static function getDataTransaksi($startDate = null, $endDate = null)
        {
            $query = Self::query();
            if ($startDate && !$endDate) {
                $query->where('tanggal', '>=', $startDate);
            }
            if (!$startDate && $endDate) {
                $query->where('tanggal', '<=', $endDate);
            }
            if ($startDate && $endDate) {
                $query->whereBetween('tanggal', [$startDate, $endDate]);
            }

            return $query->get();
        }

        public static function getRiwayat($search) {
            return Self::where('nota', 'like', '%' . $search . '%')
            ->latest()->paginate(10);
        }

}

