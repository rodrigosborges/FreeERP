<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuarioTeste extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    public function testValidaLogin()
    {
        $this->get('/point/create')->assertStatus(200);
        $this->get('/point/create')->assertViewHas('usuario');
        $this->get('/point')->assertStatus(200);
        $this->get('/point')->assertViewHas('cadastrar');
    }
    


}
