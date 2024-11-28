<?php

namespace Database\Factories;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaksi>
 */
class TransaksiFactory extends Factory
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
            'total_bayar' => fake()->randomFloat(2, 1000, 1000000),
            'jumlah_uang' => fake()->randomFloat(2, 1000, 1000000),
            'diskon' => fake()->randomFloat(2, 1000, 1000000),
            'nota' => fake()->sentence(3),
            'kasir_id' => Pengguna::factory(),
        ];
    }
}
