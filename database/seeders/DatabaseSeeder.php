<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\master_petugas as Petugas;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Petugas::create([
            'nama_petugas' => 'Administrator',
            'jabatan' => 'Petugas IT',
            'departemen' => 'IT',
            'username' => 'admins',
            'password' => Hash::make('123456')
        ]);
        // User::factory(10)->create();
    }
}
