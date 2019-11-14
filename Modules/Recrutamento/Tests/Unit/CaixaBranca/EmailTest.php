<?php

namespace Modules\Recrutamento\Tests\Unit;

use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Entities\{Endereco,Estado,Cidade, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Etapa,Email};
use Modules\Usuario\Entities\{Usuario};


class EmailTest extends TestCase
{
    public function testFormCreateEmail()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            '/recrutamento/email/',
            [
                "email" => Str::random(10).'@email.com',
            ]
        );
        $response
            ->assertRedirect("/recrutamento/email");
    }

    public function testFormUpdateEmail()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'PUT',
            '/recrutamento/email/1',
            [
                "email"=>"testeupd@email.com",
            ]
        );
        $response
            ->assertRedirect("/recrutamento/email");
    }
}
