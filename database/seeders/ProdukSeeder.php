<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\SatuanProduk;
use App\Models\KategoriProduk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::factory(100)->recycle([
            KategoriProduk::all(),
            SatuanProduk::all(),
        ])->create();
    }
}
