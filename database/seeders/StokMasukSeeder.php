<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\StokMasuk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StokMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StokMasuk::factory(100)->recycle([
            Produk::all(),
            Supplier::all(),
        ])->create();
    }
}
