<?php

namespace Database\Factories;

use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StokKeluar>
 */
class StokKeluarFactory extends Factory
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
            'barcode' => Produk::factory(),
            'jumlah' => fake()->randomNumber(3, false),
            'keterangan' => fake()->sentence(3),
        ];
    }
}
