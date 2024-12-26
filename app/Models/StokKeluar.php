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

    protected $with = ['produk'];

    public function produk(): BelongsTo {
        return $this->belongsTo(Produk::class, 'barcode_id');
    }

    public static function getStokKeluar($startDate = null, $endDate = null)
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

        public static function getDataStokKeluar($search) {
            return Self::whereHas('produk', fn($query) => $query->where('nama_produk', 'like', '%' . $search . '%')
            ->orWhere('barcode', 'like', '%' . $search . '%'))
            ->latest()->paginate(10);
        }

        protected static function booted() {
            static::created(function($stokKeluar) {
                $produk = $stokKeluar->produk;

                if($produk->stok >= $stokKeluar->jumlah) {
                    $produk->decrement('stok', $stokKeluar->jumlah);
                } else {
                    $produk->stok = 0;
                    $produk->save();
                }
            });
        }
}
