<?php

namespace Database\Factories;

use App\Models\SatuanProduk;
use App\Models\KategoriProduk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produk>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'barcode' => fake()->unique()->ean13(),
            'nama_produk' => fake()->word(),
            'kategori_id' => KategoriProduk::factory(),
            'satuan_id' => SatuanProduk::factory(),
            'harga' => (fake()->randomFloat(0, 1, 200) * 1000),
            'stok' => fake()->randomNumber(3, false),
            'terjual' => fake()->randomNumber(3, false),
            'foto' => "img/produk/default.png",
        ];
    }
}
