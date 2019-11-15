<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\assistencia\Entities\TecnicoAssistenciaModel;
class TecnicoAssistenciaTest extends TestCase
{
    public function testListServico() {
        $response = $this->get('/assistencia/tecnico');

        $response->assertStatus(200);
    }

    // public function testFormCreate()
    // {

    //     $response = $this->WithoutMiddleware()->withHeaders([
    //         'X-Header' => 'Value',
    //     ])->json(
    //         'POST',
    //         '/assistencia/tecnico/salvar',
    //         [
    //             'nome' => 'Tecnico da Silva',
    //             'cpf' => '763.892.391-06',
                
    //         ]
    //     );
    //     $response
    //     ->assertStatus(201)
    //     ->assertJson([
    //         'created' => true,
    //     ]);
    // }
}
