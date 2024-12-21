<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StokKeluar extends Model
{
    use HasFactory;
    
    protected $table = 'stok_keluar';

    protected $fillable = [
        'tanggal',
        'barcode_id',
        'jumlah',
        'keterangan',
    ];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class, 'barcode_id');
    }

    public static function getStokKeluar($startDate = null, $endDate = null)
        {
            $query = StokKeluar::query();
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
}
