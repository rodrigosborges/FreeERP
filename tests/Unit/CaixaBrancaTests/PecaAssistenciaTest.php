<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\assistencia\Entities\PecaAssistenciaModel;
class PecaAssistenciaTest extends TestCase
{
    public function testListServico() {
        $response = $this->get('/assistencia/estoque/pecas/localizar');

        $response->assertStatus(200);
    }
    // public function testFormCreate()
    // {

    //     $response = $this->WithoutMiddleware()->withHeaders([
    //         'X-Header' => 'Value',
    //     ])->json(
    //         'POST',
    //         '/assistencia/estoque/pecas/salvar',
    //         [
    //             'nome' => 'Tecnico da Silva',
    //             'valor_compra' => 20,
    //             'valor_venda' => 40,
    //             'quantidade' => 5
                
    //         ]
    //     );
    //     $response
    //     ->assertStatus(201)
    //     ->assertJson([
    //         'created' => true,
    //     ]);
    // }
}
