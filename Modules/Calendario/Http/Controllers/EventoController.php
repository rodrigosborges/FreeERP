<?php

namespace Modules\Calendario\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Compartilhamento;
use Modules\Calendario\Entities\Convite;
use Modules\Calendario\Entities\Evento;
use Modules\Calendario\Entities\Funcionario;
use Modules\Calendario\Entities\Notificacao;

class EventoController extends Controller
{
    public function eventos()
    {
        $eventos = [];
        $funcionario = Funcionario::find(1);
        $agendas = $funcionario->agendas;
        foreach ($agendas as $agenda) {
            $eventos = array_merge($eventos, $agenda->eventos_json);
        }

        $compartilhamentos = $funcionario->setor->compartilhamentos;
        foreach ($compartilhamentos as $compartilhamento) {
            if($compartilhamento->aprovacao && $compartilhamento->agenda->funcionario->id != $funcionario->id){
                $eventos = array_merge($eventos, $compartilhamento->agenda->eventos_json);
            }
        }

        return $eventos;
    }

    public function criarOuEditar(Evento $evento = null, Request $request)
    {
        $rota = $request->route()->getName();
        $agendas = Agenda::all();
        $funcionarios = Funcionario::all();
        $agenda_selecionada = $request->agenda;
        return view('calendario::eventos.criar-editar', ['agendas' => $agendas, 'evento' => $evento, 'funcionarios' => $funcionarios, 'agenda_selecionada' => $agenda_selecionada, 'rota' => $rota]);
    }

    public function salvar(Request $request)
    {
        try {
            $evento = new Evento();
            $evento->titulo = $request->eventoTitulo;
            $evento->data_inicio = $this->formatar_data($request->eventoDataInicio);
            $evento->data_fim = $this->formatar_data($request->eventoDataFim);
            $evento->dia_todo = $request->eventoDiaTodo;
            $evento->nota = $request->eventoNota;
            $agenda = Agenda::find($request->eventoAgenda);
            $evento->agenda()->associate($agenda);
            $evento->save();

            if ($request->eventoNotificacaoTempo && $request->eventoNotificacaoPeriodo) {
                $notificacao = new Notificacao();
                $notificacao->evento()->associate($evento);
                $notificacao->tempo = $request->eventoNotificacaoTempo;
                $notificacao->periodo = $request->eventoNotificacaoPeriodo;
                $notificacao->email = $request->eventoNotificacaoEmail;
                $notificacao->save();
            }

            if($request->eventoConvite){
                foreach ($request->eventoConvite as $funcionario_id){
                    $convite = new Convite();
                    $convite->funcionario()->associate(Funcionario::find($funcionario_id));
                    $convite->evento()->associate($evento);
                    $convite->save();
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('agendas.eventos.index', $agenda->id)->with('error', 'Falha ao criar evento. Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.eventos.index', $agenda->id)->with('success', 'Evento criado com sucesso.');
    }

    public function atualizar(Request $request, Evento $evento)
    {
        try {
            $evento->titulo = $request->eventoTitulo;
            $evento->data_inicio = $this->formatar_data($request->eventoDataInicio);
            $evento->data_fim = $this->formatar_data($request->eventoDataFim);
            $evento->dia_todo = $request->eventoDiaTodo;
            $evento->nota = $request->eventoNota;
            $agenda = Agenda::find($request->eventoAgenda);
            $evento->agenda()->associate($agenda);
            if ($evento->notificacao) {
                if($request->eventoNotificacaoTempo && $request->eventoNotificacaoPeriodo){
                    $evento->notificacao->tempo = $request->eventoNotificacaoTempo;
                    $evento->notificacao->periodo = $request->eventoNotificacaoPeriodo;
                    $evento->notificacao->email = $request->eventoNotificacaoEmail;
                    $evento->notificacao->save();
                } else {
                    $evento->notificacao()->delete();
                }
            } else {
                if($request->eventoNotificacaoTempo && $request->eventoNotificacaoPeriodo){
                    $notificacao = new Notificacao();
                    $notificacao->evento()->associate($evento);
                    $notificacao->tempo = $request->eventoNotificacaoTempo;
                    $notificacao->periodo = $request->eventoNotificacaoPeriodo;
                    $notificacao->email = $request->eventoNotificacaoEmail;
                    $notificacao->save();
                }
            }
            $convites = [];
            if ($request->eventoConvite) {
                foreach ($request->eventoConvite as $funcionario_id) {
                    $convites[] = Convite::firstOrCreate([
                        'evento_id' => $evento->id,
                        'funcionario_id' => $funcionario_id
                    ]);
                }
            }
            foreach ($evento->convites as $evento_convite) {
                $achou = false;
                foreach ($convites as $convite) {
                    if ($convite->is($evento_convite))
                        $achou = true;
                }
                if (!$achou)
                    $evento_convite->delete();
            }
            $evento->save();
        } catch (\Exception $e) {
            return redirect()->route('calendario.index')->with('error', 'Falha ao atualizar evento "' . $request->eventoNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('calendario.index')->with('success', 'Evento "' . $request->eventoTitulo . '" atualizado com sucesso.');
    }

    public function deletar(Evento $evento)
    {
        try {
            $evento->delete();
        } catch (\Exception $e) {
            return redirect()->route('agendas.eventos.index', $evento->agenda->id)->with('error', 'Falha ao deletar evento. Erro: ' . $e->getCode());
        }
        return redirect()->route('agendas.eventos.index', $evento->agenda->id)->with('success', 'Evento deletado com sucesso.');
    }

    public function convites(){
        $convites['pendentes'] = Convite::where('status', null)->get();
        $convites['definidos'] = Convite::where('status', '<>', null)->get();
        return view('calendario::eventos.convites', ['convites' => $convites]);
    }

    public function aceitar_convite(Convite $convite){
        $convite->status = true;
        $convite->save();
    }

    private function formatar_data($data)
    {
        $formatos = ['d/m/Y H:i', 'd/m/Y'];
        foreach ($formatos as $formato) {
            try {
                $data_formatada = Carbon::createFromFormat($formato, $data);
                break;
            } catch (\Exception $e) {
                unset($e);
            }
        }
        return $data_formatada;
    }
}
