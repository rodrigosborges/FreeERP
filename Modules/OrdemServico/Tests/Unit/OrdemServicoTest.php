<?php

namespace Modules\OrdemServico\Tests\Unit;

use Tests\TestCase;
use Modules\OrdemServico\Entities\{OrdemServico,Solicitante,Telefone,Endereco,Problema,Aparelho};
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrdemServicoTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateOrdemServico()
    {
        $endereco = Endereco::create([
            'cep' => '11600754',
            'rua' => 'Rua Colômbia',
            'bairro' => 'Jaraguá',
            'cidade_id' => 1,
            'estado_id' => 1,
            'numero' => 2,
            'complemento' => '',  
        ]);
        
        $solicitante = Solicitante::create([
            'identificacao' => '70580648061',
            'nome' => 'Rebeca Castilho Camargo',
            'email' => 'rebeca@mail.com',
            'endereco_id' => $endereco->id, 
        ]);
        
        Telefone::create([
            'numero' => '12997102173',
            'solicitante_id' => $solicitante->id,
        ]);

        $aparelho = Aparelho::create([
            'numero_serie' => '12345678',
            'tipo_aparelho' => 'celular',
            'marca' => 'lg',
            'modelo' => 'x',
            'acessorios' => '',
        ]);

        $problema = Problema::create([
            'titulo' => 'teste',
        ]);

        OrdemServico::create([
            'protocolo' =>  '5dbc3dffd93f8',
            'solicitante_id' => $solicitante->id,
            'problema_id' => $problema->id,
            'aparelho_id' => $aparelho->id,
            'descricao' => 'teste',
            'gerente_id' => 1
        ]);
        $this->assertDatabaseHas('ordem_servico',['solicitante_id' => $solicitante->id , 'aparelho_id' => $aparelho->id]);
    }
}
