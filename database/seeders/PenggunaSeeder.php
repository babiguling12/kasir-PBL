<?php

namespace Database\Seeders;

use App\Models\Pengguna;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pengguna::create([
            'username' => 'admin',
            'nama' => 'Admin',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'foto' => 'img/profile/default.png',
        ]);

        Pengguna::create([
            'username' => 'owner',
            'nama' => 'Owner',
            'password' => bcrypt('owner'),
            'role' => 'owner',
            'foto' => 'img/profile/default.png',
        ]);

        Pengguna::create([
            'username' => 'kasir',
            'nama' => 'Kasirku',
            'password' => bcrypt('kasir'),
            'role' => 'kasir',
            'foto' => 'img/profile/default.png',
        ]);

        Pengguna::factory(5)->create();
    }
}
