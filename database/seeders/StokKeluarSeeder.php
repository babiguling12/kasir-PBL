<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\StokKeluar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StokKeluarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StokKeluar::factory(100)->recycle([
            Produk::all(),
        ])->create();
    }
}
