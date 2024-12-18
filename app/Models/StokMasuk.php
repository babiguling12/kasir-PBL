<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokMasuk extends Model
{
    use HasFactory;
    
    protected $table = 'stok_masuk';

    protected $fillable = [
        'tanggal',
        'barcode_id',
        'supplier_id',
        'jumlah',
        'keterangan',
    ];

    protected $with = ['produk', 'supplier'];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class, 'barcode_id');
    }

    public function supplier(): BelongsTo {
        return $this->belongsTo(Supplier::class);
    }

    public static function getYearlyStokMasuk($year) {
        return self::selectRaw('YEAR(tanggal) as year, MONTH(tanggal) as month, SUM(jumlah) as total_stokmasuk')
            ->whereYear('tanggal', $year)
            ->groupByRaw('YEAR(tanggal), MONTH(tanggal)')
            ->orderBy('month', 'asc')
            ->get()
            ->keyBy('month'); // Optional: Key the result by month
    }
}
