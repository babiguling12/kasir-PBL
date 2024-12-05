<?php

namespace Database\Seeders;

use App\Models\SatuanProduk;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SatuanProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SatuanProduk::factory(10)->create();
    }
}
