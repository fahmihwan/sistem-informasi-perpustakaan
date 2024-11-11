<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Petugas;
use Illuminate\Database\Seeder;

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
            'username' => 'fahmihwan',
            'password' => bcrypt('qweqwe123'),
            'credential_id' => 1,
            'hak_akses' => 'kepala_sekolah'
        ]);
        Petugas::create([
            'username' => 'daris',
            'password' => bcrypt('qweqwe123'),
            'credential_id' => 2,
            'hak_akses' => 'petugas'
        ]);
        // \App\Models\User::factory(10)->create();
        \App\Models\Kategori::factory(1)->create();
        \App\Models\Pengarang::factory(1)->create();
        \App\Models\Penerbit::factory(1)->create();
        \App\Models\Rak::factory(1)->create();
        \App\Models\Tahun_terbit::factory(1)->create();
        \App\Models\Role::factory(1)->create();
        \App\Models\Anggota::factory(10)->create();
        \App\Models\Buku::factory(5)->create();




        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
