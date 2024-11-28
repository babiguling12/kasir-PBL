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
            'foto' => 'admin.jpg',
        ]);

        Pengguna::create([
            'username' => 'owner',
            'nama' => 'Owner',
            'password' => bcrypt('owner'),
            'role' => 'owner',
            'foto' => 'owner.jpg',
        ]);

        Pengguna::factory(5)->create();
    }
}
