<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProdukSeeder;
use Database\Seeders\PenggunaSeeder;
use Database\Seeders\SupplierSeeder;
use Database\Seeders\StokMasukSeeder;
use Database\Seeders\TransaksiSeeder;
use Database\Seeders\StokKeluarSeeder;
use Database\Seeders\SatuanProdukSeeder;
use Database\Seeders\KategoriProdukSeeder;
use Database\Seeders\TransaksiDetailSeeder;


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
            // KategoriProdukSeeder::class,
            // SatuanProdukSeeder::class,
            // ProdukSeeder::class,
            // SupplierSeeder::class,
            // StokMasukSeeder::class,
            // StokKeluarSeeder::class,
            PenggunaSeeder::class,
            // TransaksiSeeder::class,
            // TransaksiDetailSeeder::class,
        ]);
    }
}
