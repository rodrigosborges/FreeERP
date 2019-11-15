<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
class MaoObraAssistenciaTest extends TestCase
{
    public function testListServico() {
        $response = $this->get('/assistencia/servicos/localizar');

        $response->assertStatus(200);
    }
}
