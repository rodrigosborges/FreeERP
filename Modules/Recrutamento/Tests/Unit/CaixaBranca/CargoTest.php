<?php

namespace Modules\Recrutamento\Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\{Endereco,Estado,Cidade, Email, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Etapa};
use Modules\Usuario\Entities\{Usuario};

class CargoTest extends TestCase
{
    public function testFormCreateCargo()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/recrutamento/cargo/',
            [
                "nome" => Str::random(10),
                "categoria_id" => 2,
            ]
        );
        $response
            ->assertRedirect("/recrutamento/cargo");
    }

    public function testFormUpdateCargo()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'PUT',
            '/recrutamento/cargo/1',
            [
                "nome"=>Str::random(10),
                "categoria_id" => 2
            ]
        );
        $response
            ->assertRedirect("/recrutamento/cargo");
    }

}
