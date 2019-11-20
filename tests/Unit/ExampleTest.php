<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Eventos\Entities\Pessoa;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    
    public function testUsuarioNaoLogado()
    {
        $response = $this->get('/eventos')->assertRedirect('/login');
    }
    
    public function testUsuarioLogado()
    {
        $usuario = factory(Pessoa::class)->create();
        $response = $this->actingAs($usuario)->get('/login');
        $response->assertRedirect('/eventos');
    }
    
    public function testGetEvento()
    {
        $usuario = factory(Pessoa::class)->create();
        $response = $this->actingAs($usuario)->get('/eventos/get-evento/1');
        $response->assertOk();
    }
}
