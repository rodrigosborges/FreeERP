<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UsuarioTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  
    public function testValidaLogin()
    {
        $this->get('/http/create')->assertStatus(200);
        $this->get('/point/create')->assertViewHas('usuario');
        $this->get('/point')->assertStatus(200);
        $this->get('/point')->assertViewHas('cadastrar');
    }
    


}
