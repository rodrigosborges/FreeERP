<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    OrdemServico
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
                'model' => OrdemServico::where('tecnico_id',null)->paginate(5),
                'thead' => ['Protocolo', 'Solicitante', 'Status'],
                'row_db' => ['protocolo', 'solicitante_id', 'status_id'],
                'create' => false,
                'acoes' => []
            ];
            return view('ordemservico::tecnico.painel.ordensDisponiveis', compact('data'));
    }

    public function ordensAtivas()
    {
        $data = [
            'title' => 'Minhas Ordens de Serviços',
            'model' => OrdemServico::where('tecnico_id',Auth::user()->id)->paginate(5),
            'thead' => ['Protocolo', 'Solicitante', 'Status'],
            'row_db' => ['protocolo', 'solicitante_id', 'status_id'],
            'create' => false,
            'route' => 'modulo.tecnico.painel.',
            'acoes' => [
                ['nome' => 'Enviar Para a Manutenção' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'minhasOs'],
                ['nome' => 'Marcar Aparelho como Inutilizado' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'minhasOs']
            ]
            ];
        return view('ordemservico::ordemservico.solucao.form', compact('data'));
    }

    public function pegarResponsabilidade($id){
        $os = OrdemServico::all()->where('protocolo',$id)->first();
        $os->tecnico_id = Auth::user()->id;
        $os->save();
        return redirect()->back()->with('success', 'Ordem Ativada com successo');
    } 

}
