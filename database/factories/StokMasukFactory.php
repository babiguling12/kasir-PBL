<?php

namespace Database\Factories;

use App\Models\Produk;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokMasuk>
 */
class StokMasukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tanggal' => fake()->date(),
            'barcode_id' => Produk::factory(),
            'supplier_id' => Supplier::factory(),
            'jumlah' => fake()->randomNumber(3, false),
            'keterangan' => fake()->sentence(3),
        ];
    }
}
