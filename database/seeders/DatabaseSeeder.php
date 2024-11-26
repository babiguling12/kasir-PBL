<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Produk;
use App\Models\Pengguna;
use App\Models\Supplier;
use App\Models\StokMasuk;
use App\Models\Transaksi;
use App\Models\StokKeluar;
use App\Models\SatuanProduk;
use App\Models\KategoriProduk;
use App\Models\TransaksiDetail;
use Illuminate\Database\Seeder;
use Database\Seeders\PenggunaSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\SatuanProdukSeeder;
use Database\Seeders\KategoriProdukSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            PenggunaSeeder::class,
            SupplierSeeder::class,
            KategoriProdukSeeder::class,
            SatuanProdukSeeder::class,
        ]);

        Produk::factory(10)->recycle([
            KategoriProduk::all(),
            SatuanProduk::all(),
        ])->create();

        StokKeluar::factory(5)->recycle([
            Produk::all(),
        ])->create();

        StokMasuk::factory(5)->recycle([
            Produk::all(),
            Supplier::all(),
        ])->create();

        Transaksi::factory(10)->recycle([
            Pengguna::all(),
        ])->create();

        TransaksiDetail::factory(10)->recycle([
            Transaksi::all(),
            Produk::all(),
        ])->create();
    }
}
