<?php

namespace Modules\OrdemServico\Tests\Unit;

use Tests\TestCase;
use Modules\Usuario\Entities\{Usuario};
use Modules\OrdemServico\Entities\OrdemServico;

class OrdemServicoCBTest extends TestCase
{
    public function testFormCreateOrdemServico()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/ordemservico/os/',
            [
                "solicitante"  =>  [
                    'id' => 64857739089,
                    'nome' => 'Teste',
                    'email' => "teste@teste.com"
                ],
                'endereco' => [
                    'cep' => 11600754,
                    'rua' => 'teste',
                    'bairro' => 'teste',
                    'cidade_id' => 1,
                    'estado_id' => 1,
                    'numero' => 1,
                    'complemento' => ""
                ],
                'telefone' => [0 => ['numero' => 111111111]],
                'aparelho' => [
                    'numero_serie' => 'a1a1a1a1a',
                    'marca' => 'teste',
                    'modelo' => 'teste',
                    'tipo_aparelho' => 'teste'
                ],
                'acessorios' => '',
                'problema' => ['titulo' => 'teste'],
                'descricao' => 'teste',
            ]
        );
        $response
            ->assertRedirect("/ordemservico/os");
    }

    public function testShowOrdemServico(){
        $user = Usuario::findOrFail(1);
        $response = $this->actingAs($user)->get('/ordemservico/os/1');
        $response->assertStatus(200);
    }

    public function testEditOrdemServico(){
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'PUT',
            '/ordemservico/os/1',
            [
                'aparelho' => [
                    'numero_serie' => 'a1a1a1a1a',
                    'marca' => 'teste',
                    'modelo' => 'teste',
                    'tipo_aparelho' => 'teste'
                ],
                'acessorios' => 'cabo',
                'problema' => ['titulo' => 'teste'],
                'descricao' => 'teste',
            ]);
        
        $response
        ->assertRedirect("/ordemservico/os");
    }

    public function testUpdatePrioridade(){
        $user = Usuario::findOrFail(1);
        $protocolo = OrdemServico::findOrFail(1)->protocolo;
        
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            'ordemservico/prioridade/' . $protocolo . '/update',
            ['prioridade' => "1"]
        );
        $response
        ->assertRedirect("/ordemservico/os");
    } 
}
