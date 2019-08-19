<?php

namespace Modules\Calendario\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Evento;

class EventoController extends Controller
{
    public function criarOuEditar(Evento $evento = null){
        $agendas = Agenda::all();
        return view('calendario::eventos.criar-editar',['agendas' => $agendas, 'evento' => $evento]);
    }

    public function salvar(Request $request){
        try{
            $evento = new Evento();
            $evento->titulo = $request->eventoTitulo;
            $evento->data_inicio = $this->formatar_data($request->eventoDataInicio);
            $evento->data_fim = $this->formatar_data($request->eventoDataFim);
            $evento->notificacao = $request->eventoNotificacaoTempo * $request->eventoNotificacaoPeriodo;
            $evento->dia_todo = $request->eventoDiaTodo;
            $evento->nota = $request->eventoNota;
            $agenda = Agenda::find($request->eventoAgenda);
            $evento->agenda()->associate($agenda);
            $evento->save();
        }catch (\Exception $e){
            return redirect()->route('calendario.index')->with('error', 'Falha ao criar evento. Erro: ' . $e->getCode());
        }
        return redirect()->route('calendario.index')->with('success', 'Evento criado com sucesso.');
    }

    public function deletar(Evento $evento){
        try{
            $evento->delete();
        }catch (\Exception $e){
            return redirect()->route('agendas.eventos.index', $evento->agenda->id)->with('error', 'Falha ao deletar evento. Erro: ' . $e->getCode());
        }
        return redirect()->route('agendas.eventos.index', $evento->agenda->id)->with('success', 'Evento deletado com sucesso.');
    }

    private function formatar_data($data){
        $formatos = ['d/m/Y H:i', 'd/m/Y'];
        foreach ($formatos as $formato){
            try{
                $data_formatada = Carbon::createFromFormat($formato, $data);
                break;
            }catch (\Exception $e){
                unset($e);
            }
        }
        return $data_formatada;
    }
}
