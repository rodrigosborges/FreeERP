<?php

namespace Modules\Protocolos\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Protocolos\Entities\{Usuario, Protocolo};

class FormTestProtocolo extends TestCase
{
    
    public function testNewTimeRegistration(){
        Protocolo::create([
            'numero'                => "",
            'assunto'               => "",
            'tipo_protocolo_id'     => "1",
            'tipo_acesso'           => "1",
            'status_id'             => '1',
            'user_modificador_id'   => "1",
            'usuario_id'            => "1",
        ]);
        $this->assertFalse(false);
    }
}



