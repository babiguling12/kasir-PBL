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

    public static function getDataStokMasuk($search) {
        return Self::whereHas('produk', fn($query) => $query->where('nama_produk', 'like', '%' . $search . '%')->orWhere('barcode', 'like', '%' . $search . '%'))
        ->orWhereHas('supplier', fn($query) => $query->where('nama', 'like', '%' . $search . '%'))
        ->latest()->paginate(10);
    }


    public static function getStokMasuk($startDate = null, $endDate = null) {
        $query = self::selectRaw('DATE(tanggal) as date, SUM(jumlah) as total_stokmasuk')
                     ->groupByRaw('DATE(tanggal)')
                     ->orderBy('date', 'asc');
    
        if ($startDate && $endDate) {
            $query->whereBetween('tanggal', [$startDate, $endDate]);
        } elseif ($startDate) {
            $query->whereDate('tanggal', '>=', $startDate);
        } elseif ($endDate) {
            $query->whereDate('tanggal', '<=', $endDate);
        }
    
        return $query->get();
    }
    
}
