<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Modules\assistencia\Entities\ClienteAssistenciaModel;

class ClienteAssistencia extends TestCase
{
    public function testFormCreate()
    {

        $response = $this->WithoutMiddleware()->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/assistencia/cliente/salvar',
            [
                'nome' => 'Rodrigo Lucca da Mata',
                'cpf' => '763.892.391-06',
                'email' => 'email@ema.com',
                'data_nascimento' => '1999-05-17',
                'endereco_id' => '1',
                'celnumero' => '(17) 46483-8646',
                'telefonenumero' => '(34) 47353-4863',
                'logradouro' => 'Rua tal',
                'numero' => '45',
                'bairro' => 'Ita',
                'cidade_id' => '219',
                'cep' => '11630000',
            ]
        );
        $response
        ->assertStatus(201)
        ->assertJson([
            'created' => true,
        ]);
    }

    // public function testEditOrdemServico(){
    //     $user = Usuario::findOrFail(1);
    //     $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
    //         'X-Header' => 'Value',
    //     ])->json(
    //         'PUT',
    //         '/ordemservico/os/1',
    //         [
    //             'aparelho' => [
    //                 'numero_serie' => 'a1a1a1a1a',
    //                 'marca' => 'teste',
    //                 'modelo' => 'teste',
    //                 'tipo_aparelho' => 'teste'
    //             ],
    //             'acessorios' => 'cabo',
    //             'problema' => ['titulo' => 'teste'],
    //             'descricao' => 'teste',
    //         ]);
        
    //     $response
    //     ->assertRedirect("/ordemservico/os");
    // }
    // public function testUpdatePrioridade(){
    //     $user = Usuario::findOrFail(1);
    //     $protocolo = OrdemServico::findOrFail(1)->protocolo;
        
    //     $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
    //         'X-Header' => 'Value',
    //     ])->json(
    //         'POST',
    //         'ordemservico/prioridade/' . $protocolo . '/update',
    //         ['prioridade' => "1"]
    //     );
    //     $response
    //     ->assertRedirect("/ordemservico/os");
    // }
}
