<?php

namespace Database\Factories;

use App\Models\Pengguna;
use Illuminate\Support\Carbon;
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
        $tanggal = fake()->date();

        return [
            'tanggal' => $tanggal,
            'total_bayar' => fake()->randomFloat(2, 1000, 1000000),
            'jumlah_uang' => fake()->randomFloat(2, 1000, 1000000),
            'diskon' => fake()->randomFloat(0, 1000, 1000000),
            'nota' => 'POS'.Carbon::parse($tanggal)->format('Ymd'),
            'kasir_id' => Pengguna::factory(),
            'metode_pembayaran' => fake()->randomElement(['cash', 'transfer']),
        ];
    }
}
