<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Eventos\Entities\Evento;
use Modules\Eventos\Entities\Programacao;

class ProgramacaoController extends Controller
{
    public function exibir($id){
        $evento = Evento::find($id);
        $atividades = DB::table('programacao')->where('evento_id', $id)->get();
        //dd($atividades);
        return view('eventos::programacao', ['evento' => $evento, 'atividades' => $atividades]);
    }
    
    function cadastrar(Request $request)
    {
        $programacao = new Programacao();
        $programacao->nome = $request->nome;
        $programacao->tipo = $request->tipo;
        $programacao->descricao = $request->descricao;
        $programacao->data = $request->data;
        $programacao->horario = $request->horario;
        $programacao->duracao = $request->duracao;
        $programacao->local = $request->local;
        $programacao->vagas = $request->vagas;
        $programacao->evento_id = $request->eventoId;
        $programacao->save();
        
        return redirect()->route('programacao.exibir', ['evento' => $request->eventoId])
            ->with('success', $request->nome . ' adicionado(a) com sucesso.');
    }
}
