<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'metode_pembayaran'
    ];

    public function kasir(): BelongsTo
    {
        return $this->belongsTo(Pengguna::class);
    }

    public function transaksi_detail(): HasMany
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    public static function getDataSales($dateValue = null)
    {
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
        $query = self::query();
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

    public static function getRiwayat($search)
    {
        return self::where('nota', 'like', '%' . $search . '%')
            ->latest()->paginate(10);
    }

    public static function simpanTransaksi($data)
    {

        DB::transaction(function () use ($data) {
            $transaksi = Transaksi::create([
                'tanggal' => $data['tanggal'],
                'total_bayar' => $data['total_bayar'],
                'jumlah_uang' => $data['jumlah_uang'],
                'diskon' => $data['diskon'],
                'nota' => $data['nota'],
                'kasir_id' => auth()->user()->id,
                'metode_pembayaran' => $data['metode_pembayaran'],
            ]);

            foreach ($data['transaksi_details'] as $transaksi_detail) {
                $transaksi->transaksi_detail()->create([
                    'qty' => $transaksi_detail->qty,
                    'harga_barang' => $transaksi_detail->price,
                    'barcode_id' => $transaksi_detail->id,
                ]);

                Produk::findOrFail($transaksi_detail->id)
                    ->update([
                        'stok' => $transaksi_detail->options->stock - $transaksi_detail->qty
                    ]);
            }

            if ($data['diskon'] > 0) {
                $transaksi->transaksi_detail()->create([
                    'qty' => 1,
                    'harga_barang' => -1 * $data['diskon'],
                    'barcode_id' => 1,
                ]);
            }
        }, 5);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = '<your server key>';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        return Transaksi::latest()->first()->id;

    }
}
