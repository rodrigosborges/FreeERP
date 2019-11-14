<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\assistencia\Entities\ServicoAssistenciaModel;
class MaoObraAssistencia extends TestCase
{
    public function testFormCreate()
    {

        $response = $this->WithoutMiddleware()->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/assistencia/servicos/salvar',
            [
                'nome' => 'Tela',
                'valor' => 50,
                
            ]
        );
        $response
        ->assertStatus(201)
        ->assertJson([
            'created' => true,
        ]);
    }
}
