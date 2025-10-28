<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Domain\Product\Product;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_returns_a_list_of_products()
    {
        // Arrange: cria alguns produtos
        Product::factory()->count(3)->create();

        // Act: faz uma requisição GET para o endpoint index
        $response = $this->getJson('/api/products');

        // Assert: verifica se a resposta está correta
        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'status',
                     'data' => [
                         '*' => [
                             'id',
                             'name',
                             'description',
                             'price',
                             // adicione outros campos esperados
                         ]
                     ]
                 ]);
    }
}
