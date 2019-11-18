<?php
namespace Modules\Protocolos\Tests\Unit;
use Illuminate\Support\Str;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Protocolos\Entities\{Usuario,Protocolo,Interessado,TipoProtocolo,TipoAcesso};

class ProtocoloTest extends TestCase
{
    public function testFormCreateProtocolo()
    {
        $user = Usuario::findOrFail(1);
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            'protocolos/protocolos',
            [
                "protocolo" => [
                    "usuario_id" => "1",
                    "tipo_protocolo_id" => "2",
                    "tipo_acesso" => "0",
                ],
                "interessados" => "2",
                "pesquisa" => null,
                "assunto" => "Testando testando testando testando",
            ]
        );
        $response
            ->assertStatus(200);
    }

}