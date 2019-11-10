<?php

namespace Modules\OrdemServico\Tests\Unit;

use Tests\TestCase;
use Modules\Usuario\Entities\{Usuario};
use Modules\OrdemServico\Entities\OrdemServico;

class StatusCPTest extends TestCase
{
    public function testCreateStatus(){
        $user = Usuario::findOrFail(1);
        
        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            'ordemservico/status/store',
            ['titulo' => str_random(5)]
        );
        $response
        ->assertStatus(302);
    } 

    public function testUpdateStatus(){
        $user = Usuario::findOrFail(1);
        $protocolo = OrdemServico::findOrFail(1)->protocolo;

        $response = $this->WithoutMiddleware()->actingAs($user)->withHeaders([
            'X-Header' => 'Value',
        ])->json(
            'POST',
            'ordemservico/os/status/'.$protocolo . '/updateStatus',
            ['status_id' => "1"]
        );
        $response
        ->assertStatus(302);
    } 
}
