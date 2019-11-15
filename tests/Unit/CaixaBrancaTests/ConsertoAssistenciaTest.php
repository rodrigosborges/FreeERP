<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
class ConsertoAssitenciaTest extends TestCase
{
    public function testListOs() {
        $response = $this->get('/assistencia/consertos');

        $response->assertStatus(200);
    }
}
