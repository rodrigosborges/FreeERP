<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;
use Modules\Calendario\Entities\Cor;
use Modules\Calendario\Http\Requests\AgendaSalvarRequest;

class AgendaController extends Controller
{
    public function criarOuEditar(Agenda $agenda = null){
        $cores = Cor::all();
        return view('calendario::agendas.criar-editar', ['cores' => $cores, 'agenda' => $agenda]);
    }

    public function salvar(AgendaSalvarRequest $request){
        try{
            $agenda = new Agenda();
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $cor = Cor::find($request->agendaCor);
            $agenda->cor()->associate($cor);
            //TODO Incluir o usuário logado
            $agenda->funcionario_id = 1;
            $agenda->save();
        }catch (QueryException $e){
            return redirect()->route('calendario.index')->with('error', 'Falha ao criar agenda "'. $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('calendario.index')->with('success', 'Agenda "' . $request->agendaNome . '" criada com sucesso.');
    }

    public function atualizar(AgendaSalvarRequest $request, Agenda $agenda){
        try{
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $cor = Cor::find($request->agendaCor);
            $agenda->cor()->associate($cor);
            $agenda->save();
        }catch (\Exception $e){
            return redirect()->route('calendario.index')->with('error', 'Falha ao atualizar agenda "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
        return redirect()->route('calendario.index')->with('success', 'Agenda "' . $request->agendaNome . '" atualizada com sucesso.');
    }

    public function eventos()
    {
        $eventos = [];
        $agendas = Agenda::where('funcionario_id', 1)->get();
        foreach ($agendas as $agenda){
            $eventos = array_merge($eventos, $agenda->eventos_json);
        }
        return $eventos;
    }
}
