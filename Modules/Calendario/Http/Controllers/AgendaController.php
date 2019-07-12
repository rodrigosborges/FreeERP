<?php

namespace Modules\Calendario\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Calendario\Entities\Agenda;

class AgendaController extends Controller
{
    public function criar(){
        return view('calendario::agendas.criar');
    }

    public function salvar(Request $request){
        try{
            $agenda = new Agenda();
            $agenda->titulo = $request->agendaNome;
            $agenda->descricao = $request->agendaDescricao;
            $agenda->cor = $request->agendaCor;
            //TODO Incluir o usuário logado
            $agenda->funcionario_id = 1;
            $agenda->save();
        }catch (QueryException $e){
            return redirect()->route('calendario.index')->with('error', 'Falha ao criar agenda. Erro: ' . $e->getCode());
        }
        return redirect()->route('calendario.index')->with('success', 'Agenda criada com sucesso.');
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
