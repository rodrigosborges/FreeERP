<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Aprovacao;
use Modules\Calendario\Entities\Compartilhamento;
use Modules\Calendario\Entities\Funcionario;
use Modules\Calendario\Entities\Setor;
use Modules\Calendario\Entities\Cor;
use Modules\Calendario\Http\Requests\AgendaSalvarRequest;

class AgendaController extends Controller
{
    public function agendas()
    {
        $agendas = Agenda::withTrashed('funcionario_id', 1)->orderByRaw('deleted_at DESC, created_at DESC')->get();
        $lixeira = Agenda::onlyTrashed()->where('funcionario_id', 1)->count();
        return view('calendario::agendas.index', ['agendas' => $agendas, 'lixeira' => $lixeira]);
    }

    public function criarOuEditar(Agenda $agenda = null)
    {
        $cores = Cor::all();
        $setores = Setor::all();
        return view('calendario::agendas.criar-editar', ['cores' => $cores, 'agenda' => $agenda, 'setores' => $setores]);
    }

    public function salvar(AgendaSalvarRequest $request)
    {
        try {
            $agenda = new Agenda();
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $agenda->cor()->associate(Cor::find($request->agendaCor));
            //TODO Incluir o usuário logado
            $agenda->funcionario()->associate(Funcionario::find(1));
            $agenda->save();
            if ($request->agendaCompartilhamento) {
                foreach ($request->agendaCompartilhamento as $setor_id) {
                    $compartilhamento = new Compartilhamento();
                    $compartilhamento->setor()->associate(Setor::find($setor_id));
                    $compartilhamento->funcionario_id = 1;
                    $agenda->compartilhamentos()->save($compartilhamento);
                }
            }
        } catch (QueryException $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao criar agenda "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda "' . $request->agendaNome . '" criada com sucesso.');
    }

    public function atualizar(AgendaSalvarRequest $request, Agenda $agenda)
    {
        try {
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $agenda->cor()->associate(Cor::find($request->agendaCor));
            $agenda->save();
            $compartilhamentos = [];
            if ($request->agendaCompartilhamento) {
                foreach ($request->agendaCompartilhamento as $setor_id) {
                    $compartilhamentos[] = Compartilhamento::firstOrCreate([
                        'setor_id' => $setor_id,
                        'agenda_id' => $agenda->id,
                        'funcionario_id' => 1
                    ]);
                }
            }
            foreach ($agenda->compartilhamentos as $agenda_compartilhamento) {
                $achou = false;
                foreach ($compartilhamentos as $compartilhamento) {
                    if ($compartilhamento->is($agenda_compartilhamento))
                        $achou = true;
                }
                if (!$achou)
                    $agenda_compartilhamento->delete();
            }
        } catch (\Exception $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao atualizar agenda "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda "' . $request->agendaNome . '" atualizada com sucesso.');
    }

    public function deletar(Agenda $agenda)
    {
        try {
            if ($agenda->trashed())
                $agenda->forceDelete();
            else
                $agenda->delete();
        } catch (\Exception $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao deletar agenda. Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda deletada com sucesso.');
    }

    public function restaurar(Agenda $agenda)
    {
        try {
            $agenda->restore();
        } catch (\Exception $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao restaurar agenda. Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda restaurada com sucesso.');
    }

    public function compartilhamentos(){
        $agendas = Agenda::all();
        $solicitacoes['pendentes'] = [];
        $solicitacoes['aprovadas'] = [];
        foreach ($agendas as $agenda){
            foreach ($agenda->compartilhamentos as $compartilhamento){
                if(!$compartilhamento->aprovacao){
                    array_push($solicitacoes['pendentes'], $compartilhamento);
                }
                else{
                    array_push($solicitacoes['aprovadas'], $compartilhamento);
                }
            }
        }
        return view('calendario::agendas.compartilhamentos', ['solicitacoes' => $solicitacoes]);
    }

    public function aprovar_compartilhamento(Compartilhamento $compartilhamento){
        $aprovacao = new Aprovacao();
        $aprovacao->funcionario_id = 1;
        $compartilhamento->aprovacao()->save($aprovacao);
        return redirect()->back();
    }

    public function negar_compartilhamento(Compartilhamento $compartilhamento){
        $compartilhamento->delete();
        return redirect()->back();
    }

    public function revogar_aprovacao(Compartilhamento $compartilhamento){
        $compartilhamento->aprovacao()->delete();
        return redirect()->back();
    }

    public function eventos(Agenda $agenda)
    {
        return view('calendario::eventos.index', ['eventos' => $agenda->eventos, 'agenda' => $agenda]);
    }
}
