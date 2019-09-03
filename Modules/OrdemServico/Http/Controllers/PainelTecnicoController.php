<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    Tecnico,
    OrdemServico
};
use DB;

class PainelTecnicoController extends Controller
{

    public function index($id){
        $data = [
            'model' => Tecnico::findOrFail($id)
        ];
        return view('ordemservico::tecnico.painel.index',compact('data'));
    }

    public function ordensDisponiveis($id){
        $data = [
            'title' => 'Ordens Disponíveis',
            'tecnico' => Tecnico::findOrFail($id),
            'model' => OrdemServico::where('tecnico_id',null)->paginate(5),
            'inativos' => [],
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('ordem_servico'),0,4),
            'cadastro' => '',
            'deletar' => false,
            'route' => 'modulo.tecnico.',
            'acoes' => [
                ['nome' => 'Pegar Responsabilidade' , 'class' => 'pegar-responsabilidade btn btn-outline-info btn-sm'],
            ]
            ];
        return view('ordemservico::tecnico.painel.ordensDisponiveis', compact('data'));
    }

    public function ordensAtivas($id)
    {
        $data = [
            'title' => 'Minhas Ordens de Serviços',
            'model' => Tecnico::findOrFail($id)->ordem_servico()->paginate(5),
            'inativos' => [],
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('ordem_servico'),0,4),
            'cadastro' => '',
            'deletar' => false,
            'route' => 'modulo.tecnico.',
            'acoes' => [
                ['nome' => 'Relatar Solução' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'index'],
                ['nome' => 'Enviar Para a Manutenção' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'index'],
                ['nome' => 'Marcar Aparelho como Inutilizado' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'index']
            ]
            ];
        return view('ordemservico::layouts.index', compact('data'));
    }

    public function pegarResponsabilidade($idTecnico,$idOs){
        $os = OrdemServico::findOrFail($idOs);
        $os->tecnico_id = $idTecnico;
        $os->save();
        return redirect('/ordemservico/painel/'. $idTecnico)->with('success', 'Ordem Ativada com successo');
    }

}
