<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Setor;
use Modules\Calendario\Entities\Tipo;
use Modules\Calendario\Entities\Cor;
use Modules\Calendario\Http\Requests\AgendaSalvarRequest;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::where('funcionario_id', 1)->get();
        return view('calendario::agendas.index', ['agendas' => $agendas]);
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
            $cor = Cor::find($request->agendaCor);
            $agenda->cor()->associate($cor);

            if ($request->agendaCompartilhamento != 0) {
                $setor = Setor::find($request->agendaCompartilhamento);
                $agenda->setor()->associate($setor);
            }
            //TODO Incluir o usuário logado
            $agenda->funcionario_id = 1;
            $agenda->save();
        } catch (QueryException $e) {
            return redirect()->route('calendario.index')->with('error', 'Falha ao criar agenda "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('calendario.index')->with('success', 'Agenda "' . $request->agendaNome . '" criada com sucesso.');
    }

    public function atualizar(AgendaSalvarRequest $request, Agenda $agenda)
    {
        try {
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $cor = Cor::find($request->agendaCor);
            $agenda->cor()->associate($cor);
            if ($request->agendaCompartilhamento != 0) {
                $setor = Setor::find($request->agendaCompartilhamento);
                $agenda->setor()->associate($setor);
            }
            else{
                $agenda->setor()->dissociate();
            }
            $agenda->save();
        } catch (\Exception $e) {
            return redirect()->route('agendas.index')->with('error', 'Falha ao atualizar agenda "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('agendas.index')->with('success', 'Agenda "' . $request->agendaNome . '" atualizada com sucesso.');
    }

    public function eventos()
    {
        $eventos = [];
        $agendas = Agenda::where('funcionario_id', 1)->get();
        foreach ($agendas as $agenda) {
            $eventos = array_merge($eventos, $agenda->eventos_json);
        }
        return $eventos;
    }
}
