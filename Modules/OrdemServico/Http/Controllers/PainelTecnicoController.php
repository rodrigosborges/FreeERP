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

    public function ordensDisponiveis(){
        $data = [
            'title' => 'Ordens Disponíveis',
            'model' => OrdemServico::where('status','Iniciado')->paginate(5),
            'inativos' => [],
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('ordem_servico'),0,4),
            'cadastro' => '',
            'route' => 'modulo.tecnico.',
            'acoes' => [
                ['nome' => 'Pegar Responsabilidade' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'index'],
            ]
            ];
        return view('ordemservico::layouts.index', compact('data'));
    }

    public function ordensAtivas($id)
    {
        $data = [
            'title' => 'Minhas Ordens de Serviços',
            'model' => Tecnico::findOrFail($id)->ordem_servico()->paginate(5),
            'inativos' => [],
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('ordem_servico'),0,4),
            'cadastro' => '',
            'route' => 'modulo.tecnico.',
            'acoes' => [
                ['nome' => 'Relatar Solução' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'index'],
                ['nome' => 'Enviar Para a Manutenção' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'index'],
                ['nome' => 'Marcar Aparelho como Inutilizado' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'index']
            ]
            ];
        return view('ordemservico::layouts.index', compact('data'));
    }


}
