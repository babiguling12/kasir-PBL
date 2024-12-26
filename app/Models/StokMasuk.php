<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
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
        $query = self::selectRaw('DATE(tanggal) as date, barcode_id , SUM(jumlah) as total_stokmasuk')
        ->groupBy(DB::raw('DATE(tanggal), barcode_id'))
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

    protected static function booted() {
        static::created(function($stokMasuk) { // created : trigger insert after
            $produk = $stokMasuk->produk;
            if($produk) {
                $produk->increment('stok', $stokMasuk->jumlah);
            }
        });

        static::updated(function($stokMasuk) { // updated : trigger update after
            $produk = $stokMasuk->produk;

            if($produk && $stokMasuk->isDirty('jumlah')) { // isDirty() untuk mengecek kolom tertentu apakah sudah diubah atau belum
                $selisih = $stokMasuk->jumlah - $stokMasuk->getOriginal('jumlah'); // getOriginal() mendapatkan nilai sebelum diubah
                $produk->increment('stok', $selisih);
            }
        });
    }

}
