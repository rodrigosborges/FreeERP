<?php

namespace Modules\Protocolos\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Protocolos\Entities\{Usuario, Protocolo};

class ProtocoloFormTest extends TestCase
{
    
    public function testCreateProtocolo(){
        Protocolo::create([
            'numero'                => "1-2019",
            'assunto'               => "Estou testando o create de Protocolo.",
            'tipo_protocolo_id'     => "1",
            'tipo_acesso'           => "1",
            'status_id'             => '1',
            'user_modificador_id'   => "1",
            'usuario_id'            => "1",
        ]);
        $this->assertDatabaseHas('protocolo', ['numero' => '1-2019']);
    }
}



