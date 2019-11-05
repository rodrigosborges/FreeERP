<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Aprovacao;
use Modules\Calendario\Entities\Compartilhamento;
use Modules\Calendario\Entities\Funcionario;
use Modules\Calendario\Entities\Setor;
use Modules\Calendario\Entities\Cor;
use Modules\Calendario\Http\Requests\AgendaSalvarRequest;

class AgendaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function agendas()
    {
        $funcionario = Funcionario::where('user_id', Auth::id())->first();
        $agendas = Agenda::withTrashed()->where('funcionario_id', $funcionario->id)->orderByRaw('deleted_at DESC, created_at DESC')->get();
        $lixeira = Agenda::onlyTrashed()->where('funcionario_id', $funcionario->id)->count();
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
            $funcionario = Funcionario::where('user_id', Auth::id())->first();
            $agenda = new Agenda();
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $agenda->cor()->associate(Cor::find($request->agendaCor));
            //TODO Incluir o usuário logado
            $agenda->funcionario()->associate($funcionario);
            $agenda->save();
            if ($request->agendaCompartilhamento) {
                foreach ($request->agendaCompartilhamento as $setor_id) {
                    $compartilhamento = new Compartilhamento();
                    $compartilhamento->setor()->associate(Setor::find($setor_id));
                    $compartilhamento->funcionario()->associate($funcionario);
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
                        'funcionario_id' => Funcionario::where('user_id', Auth::id())->first()->id
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

    public function aprovarCompartilhamento(Compartilhamento $compartilhamento){
        $aprovacao = new Aprovacao();
        $aprovacao->funcionario()->associate(Funcionario::where('user_id', Auth::id())->first());
        $compartilhamento->aprovacao()->save($aprovacao);
        return redirect()->back()->with('success', 'Compartilhamento aprovado com sucesso.');
    }

    public function negarCompartilhamento(Compartilhamento $compartilhamento){
        $compartilhamento->delete();
        return redirect()->back()->with('success', 'Compartilhamento negado com sucesso.');
    }

    public function revogarAprovacao(Compartilhamento $compartilhamento){
        $compartilhamento->aprovacao()->delete();
        return redirect()->back()->with('success', 'Compartilhamento revogado com sucesso.');
    }

    public function eventos(Agenda $agenda)
    {
        if(!$agenda->eventos->isEmpty())
            $retorno = view('calendario::eventos.index', ['eventos' => $agenda->eventos, 'agenda' => $agenda]);
        else
            $retorno = redirect()->route('agendas.index');

        return $retorno;
    }
}
