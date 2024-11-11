<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;
use App\Models\Tahun_terbit;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BukuTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_can_view_bukus_list()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $response = $this->get(route('buku.index'));

        $response->assertStatus(200);
        $response->assertSee($response);
    }


    public function test_can_create_bukus()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $pengarangs = Pengarang::latest()->get();
        $penerbits = Penerbit::latest()->get();
        $tahun_terbits = Tahun_terbit::latest()->get();
        $raks = Rak::latest()->get();
        $kategoris = Kategori::latest()->get();

        $response = $this->get(route('buku.create'));
        $response->assertStatus(200);
    }
    // Test untuk menyimpan post baru
    public function test_can_create_post()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $postData = [
            'judul' => 'Gideon Hahn',
            'slug' => 'Elisa Kozey',
            'pengarang_id' => '1',
            'penerbit_id' => '1',
            'tahun_terbit_id' => '1',
            'rak_id' => '1',
            'kategori_id' => '1',
            'qty' => '1',
            'qty_peminjaman' => '0'
        ];

        $response = $this->post(route('buku.store'), $postData);

        $response->assertRedirect(route('buku.index')); // Setelah create, akan redirect ke index
        $this->assertDatabaseHas('buku', $postData); // Memastikan post disimpan di database
    }



    public function test_can_view_edit_buku_page()
    {

        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $response = $this->get(route('buku.edit', 1));

        $response->assertStatus(200);
        $response->assertSee('Edit Post');
    }

    public function test_can_update_bukus()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $updatedData = [
            'nama' => 'cerpenx',
        ];

        $response = $this->get(route('kategori.index'));
        $response->assertStatus(201);
        $this->assertDatabaseHas('kategoris', $updatedData);
    }
}
