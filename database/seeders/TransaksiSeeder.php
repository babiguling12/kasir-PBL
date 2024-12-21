<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use App\Models\Transaksi;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Transaksi::factory(25)->recycle([
            Pengguna::all(),
        ])->create();
    }
}
