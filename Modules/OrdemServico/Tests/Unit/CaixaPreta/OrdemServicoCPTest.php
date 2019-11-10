<?php

namespace Modules\OrdemServico\Tests\Unit;

use Tests\TestCase;
use Modules\Usuario\Entities\{Usuario};

class OrdemServicoCPTest extends TestCase
{
    public function testCPFInvalido()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/ordemservico/os/',
            [
                "solicitante"  =>  [
                    'id' => 64873909,
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
        ->assertStatus(422);
    }
    public function testNumeroEnderecoInvalido()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/ordemservico/os/',
            [
                "solicitante"  =>  [
                    'id' => 64873909,
                    'nome' => 'Teste',
                    'email' => "teste@teste.com"
                ],
                'endereco' => [
                    'cep' => 11600754,
                    'rua' => 'teste',
                    'bairro' => 'teste',
                    'cidade_id' => 1,
                    'estado_id' => 1,
                    'numero' => '1kook',
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
        ->assertStatus(422);
    }
    public function testTelefoneInvalido()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/ordemservico/os/',
            [
                "solicitante"  =>  [
                    'id' => 64873909,
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
                'telefone' => [0 => ['numero' => 1111111]],
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
        ->assertStatus(422);
    }

    //Um solicitante só pode ter 3 telefones
    public function testQuantidadeTelefone()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/ordemservico/os/',
            [
                "solicitante"  =>  [
                    'id' => 64873909,
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
                'telefone' => [0 => ['numero' => 111111111],1 => ['numero' => 2222222222],2 => ['numero' => 333333333]],
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
            ->assertStatus(422);
    }
}
