<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Buku>
 */
class BukuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul' => fake()->name(),
            'slug' => fake()->name(),
            'pengarang_id' => 1,
            'penerbit_id' => 1,
            'rak_id' => 1,
            'tahun_terbit_id' => 1,
            'kategori_id' => 1,
            'qty' => 20,
            'qty_peminjaman' => 0,
        ];
    }
}
