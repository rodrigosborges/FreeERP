<?php

namespace Tests\Unit;

use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Cor;
use Modules\Calendario\Entities\Funcionario;
use Tests\TestCase;

class AgendaTest extends TestCase
{
    public function test_criar_agenda_sem_auth()
    {
        $data = [
            'agendaNome' => "Agenda teste nome",
            'agendaDescricao' => "Agenda teste descriçao",
            'agendaCor' => factory(Cor::class)->create()->id
        ];

        $response = $this->json('POST', '/calendario/agendas', $data);
        $response->assertStatus(401);
    }

    public function test_criar_agenda()
    {
        $data = [
            'agendaNome' => "Agenda teste nome",
            'agendaDescricao' => "Agenda teste descriçao",
            'agendaCor' => factory(Cor::class)->create()->id
        ];

        $user = factory(Funcionario::class)->create();
        $response = $this->actingAs($user->user)->post('/calendario/agendas', $data);
        $response->assertStatus(302);
        $response->assertSessionMissing(['error']);
    }

    public function test_recuperar_agendas()
    {
        $user = factory(Funcionario::class)->create();
        $response = $this->actingAs($user->user)->get('calendario/agendas');
        $response->assertStatus(200);
        $response->assertViewHas('agendas');
        $response->assertSessionMissing(['error']);
    }

    public function test_atualizar_agenda()
    {
        $agenda = factory(Agenda::class)->create();
        $response = $this->actingAs($agenda->funcionario->user)->get('calendario/agendas');
        $response->assertStatus(200);
        $response->assertViewHas('agendas');
        $response->assertSessionMissing(['error']);
        $product = $response->getOriginalContent()->getData();
        $product = $product['agendas'][0];
        $update = $this->actingAs($agenda->funcionario->user)->json('PUT', 'calendario/agendas/'.$product->id,[
            'agendaNome' => "Testando",
            'agendaCor' => $product->cor->id
        ]);
        $update->assertStatus(302);
        $update->assertSessionMissing(['error']);
    }

    public function test_excluir_agenda()
    {
        $agenda = factory(Agenda::class)->create();
        $response = $this->actingAs($agenda->funcionario->user)->get('calendario/agendas');
        $product = $response->getOriginalContent()->getData();
        $product = $product['agendas'][0];
        $delete = $this->actingAs($agenda->funcionario->user)->json('DELETE', 'calendario/agendas/'.$product->id);
        $delete->assertStatus(302);
        $delete->assertSessionMissing(['error']);
    }

    public function teste_acessar_agenda_de_outro_usuario(){
        $user = factory(Funcionario::class)->create();
        $agenda = factory(Agenda::class)->create();
        $response = $this->actingAs($user->user)->get('/calendario/agendas/' . $agenda->id);
        $response->assertStatus(403);
    }
}
