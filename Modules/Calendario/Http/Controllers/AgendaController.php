<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Compartilhamento;
use Modules\Calendario\Entities\Setor;
use Modules\Calendario\Entities\Cor;
use Modules\Calendario\Http\Requests\AgendaSalvarRequest;

class AgendaController extends Controller
{
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
            $agenda->funcionario_id = 1;
            $agenda->save();
            if ($request->agendaCompartilhamento) {
                foreach ($request->agendaCompartilhamento as $setor_id) {
                    $compartilhamento = new Compartilhamento();
                    $compartilhamento->setor()->associate(Setor::find($setor_id));
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
                        'agenda_id' => $agenda->id
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

    public function aprovarCompartilhamento(Compartilhamento $compartilhamento){
        $compartilhamento->aprovado = true;
        $compartilhamento->save();
    }

    public function eventos(Agenda $agenda)
    {
        return view('calendario::eventos.index', ['eventos' => $agenda->eventos, 'agenda' => $agenda->titulo]);
    }
}
