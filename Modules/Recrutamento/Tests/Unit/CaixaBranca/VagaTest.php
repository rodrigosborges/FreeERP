<?php

namespace Modules\Recrutamento\Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\{Endereco,Estado,Cidade, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Etapa,Email};
use Modules\Usuario\Entities\{Usuario};

class VagaTest extends TestCase
{
    public function testFormCreateVaga()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/recrutamento/vaga/',
            [
                "cargo_id" => "1",
                "salario" => "A Combinar",
                "escolaridade" => "medio",
                "status" => "1",
                "regime" => "clt",
                "beneficios" => "Vale Alimentação,Vale Refeição",
                "descricao" => "DESCRIÇÃO TESTE",
                "especificacoes" => "ESPECIFICACAO TESTE",
            ]
        );
        $response
            ->assertRedirect("/recrutamento/vaga");
    }

    public function testFormUpdateVaga()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'PUT',
            '/recrutamento/vaga/1',
            [
                "cargo_id" => "1",
                "salario" => "A Combinar",
                "escolaridade" => "medio",
                "status" => "1",
                "regime" => "clt",
                "beneficios" => "Vale Alimentação,Vale Refeição",
                "descricao" => "DESCRIÇÃO TESTE",
                "especificacoes" => "ESPECIFICACAO TESTE",
            ]
        );
        $response
            ->assertRedirect("/recrutamento/vaga");
    }

}
