<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
class PagamentoAssistenciaTest extends TestCase
{
    public function testListPag() {
        $response = $this->get('/assistencia/pagamento');

        $response->assertStatus(200);
    }
}
