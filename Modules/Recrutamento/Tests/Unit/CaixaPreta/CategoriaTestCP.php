<?php

namespace Modules\Recrutamento\Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\{Endereco,Estado,Cidade, Email, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Etapa};
use Modules\Usuario\Entities\{Usuario};


class CategoriaTestCP extends TestCase
{
    

    public function testFormCreateCategoria()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/recrutamento/categoria/',
            [
                "nome"=>''
            ]
        );
        $response
            ->assertStatus(422);
    }

    public function testFormUpdateCategoria()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'PUT',
            '/recrutamento/categoria/1',
            [
                "nome"=> ''
            ]
        );
        $response
            ->assertStatus(422);
    }

}
