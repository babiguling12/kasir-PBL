<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransaksiDetail>
 */
class TransaksiDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaksi_id' => Transaksi::factory(),
            'qty' => fake()->randomDigitNotNull(),
            'total_harga_barang' => fake()->randomFloat(2, 100, 1000),
            'barcode' => Produk::factory(),
        ];
    }
}
