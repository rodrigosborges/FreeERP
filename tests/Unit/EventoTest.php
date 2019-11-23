<?php

namespace Tests\Unit;

use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Evento;
use Modules\Calendario\Entities\Funcionario;
use Tests\TestCase;

class EventoTest extends TestCase
{
    public function test_criar_evento_sem_auth()
    {
        $data = [
            'eventoTitulo' => 'Nome do evento',
            'eventoDataInicio' => '21/11/2019 19:00',
            'eventoDataFim' => '21/11/2019 20:00',
            'eventoNotificacaoTempo' => '10',
            'eventoNotificacaoPeriodo' => '600',
        ];

        $response = $this->json('POST', '/calendario/agendas/eventos', $data);
        $response->assertStatus(401);
    }

    public function test_criar_evento()
    {
        session()->flash('evento_origem', route('calendario.index'));

        $agenda = factory(Agenda::class)->create();

        $data = [
            'eventoTitulo' => 'Nome do evento',
            'eventoDataInicio' => '21/11/2019 19:00',
            'eventoDataFim' => '21/11/2019 20:00',
            'eventoNotificacaoTempo' => '10',
            'eventoNotificacaoPeriodo' => '600',
            'eventoAgenda' => $agenda->id
        ];

        $response = $this->actingAs($agenda->funcionario->user)->post('/calendario/agendas/eventos', $data);
        $response->assertStatus(302);
        $response->assertSessionMissing(['error']);
    }

    public function test_recuperar_eventos()
    {
        session()->flash('evento_origem', route('calendario.index'));

        $agenda = factory(Agenda::class)->create();

        $data = [
            'eventoTitulo' => 'Nome do evento',
            'eventoDataInicio' => '21/11/2019 19:00',
            'eventoDataFim' => '21/11/2019 20:00',
            'eventoNotificacaoTempo' => '10',
            'eventoNotificacaoPeriodo' => '600',
            'eventoAgenda' => $agenda->id
        ];

        $this->actingAs($agenda->funcionario->user)->post('/calendario/agendas/eventos', $data);
        $response = $this->actingAs($agenda->funcionario->user)->get('/calendario/agendas/' . $agenda->id . '/eventos');
        $response->assertStatus(200);
        $response->assertViewHas(['eventos', 'agenda']);
        $response->assertSessionMissing(['error', 'warning']);
    }

    public function test_atualizar_evento()
    {
        session()->flash('evento_origem', route('calendario.index'));

        $evento = factory(Evento::class)->create();

        $update = $this->actingAs($evento->agenda->funcionario->user)->json('PUT', 'calendario/agendas/eventos/'.$evento->id,[
            'eventoTitulo' => "Testando",
            'eventoDataInicio' => $evento->data_inicio,
            'eventoDataFim' => $evento->data_fim
        ]);

        $update->assertStatus(302);
        $update->assertSessionMissing(['error']);
    }

    public function test_excluir_evento()
    {
        $evento = factory(Evento::class)->create();
        $delete = $this->actingAs($evento->agenda->funcionario->user)->json('GET', '/calendario/agendas/eventos/' . $evento->id . '/deletar');
        $delete->assertStatus(302);
        $delete->assertSessionMissing(['error']);
    }

    public function test_acessar_evento_de_outro_usuario(){
        $user = factory(Funcionario::class)->create();
        $evento = factory(Evento::class)->create();
        $response = $this->actingAs($user->user)->get('calendario/agendas/eventos/' . $evento->id);
        $response->assertStatus(403);
    }

    public function test_criar_evento_com_data_final_menor_que_inicial(){
        session()->flash('evento_origem', route('calendario.index'));

        $agenda = factory(Agenda::class)->create();

        $data = [
            'eventoTitulo' => 'Nome do evento',
            'eventoDataInicio' => '21/11/2019 19:00',
            'eventoDataFim' => '21/11/2019 18:59',
            'eventoNotificacaoTempo' => '10',
            'eventoNotificacaoPeriodo' => '600',
            'eventoAgenda' => $agenda->id
        ];

        $response = $this->actingAs($agenda->funcionario->user)->post('/calendario/agendas/eventos', $data);
        $response->assertStatus(302);
        $response->assertSessionHas(['errors']);
    }
}
