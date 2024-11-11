<?php

namespace Tests\Feature;

use App\Models\Kategori;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class KategoriTest extends TestCase
{
    // use WithoutMiddleware;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_can_view_kategoris_list()
    {
        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $response = $this->get(route('kategori.index'));

        $response->assertStatus(200);
        $response->assertSee($response->nameds);
    }



    public function test_can_create_kategoris()
    {
        $postData = [
            'nama' => 'cerpen',
        ];

        $response = $this->post(route('kategori.store'), $postData);
        $response = $this->get(route('kategori.index'));
        $this->assertDatabaseHas('kategoris', $postData);
    }

    public function test_can_view_edit_post_page()
    {

        $this->withoutExceptionHandling();
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $response = $this->get(route('kategori.edit', 1));

        $response->assertStatus(200);
        $response->assertSee('Edit Post');
    }

    public function test_can_update_kategoris()
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

    public function test_can_delete_post()
    {
        $response = $this->delete(route('kategori.destroy', 15));
        $response = $this->get(route('kategori.index'));
        $this->assertDatabaseMissing('kategoris', ['id' => 15]);
    }
}
