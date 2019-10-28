<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    OrdemServico,
    Status
};
use DB;

class PainelTecnicoController extends Controller
{

    public function index(){
        $data = [
            'model' => Auth::user()
        ];
        return view('ordemservico::tecnico.painel.index',compact('data'));
    }

    public function ordensDisponiveis(){
  
            $data = [
                'title' => 'Ordens Disponíveis',
                'model' => OrdemServico::where('tecnico_id',null)->get(),
                'thead' => ['Protocolo', 'Solicitante', 'Status'],
                'row_db' => ['protocolo', 'solicitante_id', 'status_id'],
                'create' => false,
                'acoes' => []
            ];
            return view('ordemservico::tecnico.painel.ordensDisponiveis', compact('data'));
    }

    public function ordensAtivas()
    {
        $idStatusConcluida = Status::all()->where('titulo','Concluída')->first()->id;
        $idStatusInutilizado = Status::all()->where('titulo','Marcado como Inutilizável')->first()->id;   
        $data = [
            'title' => 'Minhas Ordens de Serviços',
            'model' => OrdemServico::where('tecnico_id',Auth::user()->id)->where('status_id','<>',$idStatusConcluida)->where('status_id','<>',$idStatusInutilizado)->get(),
            'thead' => ['Protocolo', 'Solicitante', 'Status'],
            'row_db' => ['protocolo', 'solicitante_id', 'status_id'],
            'create' => false,
            'status' => Status::pluck('titulo', 'id'),
            'route' => 'modulo.tecnico.painel.',
            'acoes' => []
            ];
        return view('ordemservico::tecnico.painel.minhasOS', compact('data'));
    }

    public function pegarResponsabilidade($id){
        $os = OrdemServico::all()->where('protocolo',$id)->first();
        $os->tecnico_id = Auth::user()->id;
        $os->save();
        return redirect()->back()->with('success', 'Ordem Ativada com successo');
    } 

}
