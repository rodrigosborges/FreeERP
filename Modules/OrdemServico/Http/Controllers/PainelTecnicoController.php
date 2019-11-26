<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities\{
    OrdemServico,
    Status,
    Problema,
    Solucao
};
use DB;

class PainelTecnicoController extends Controller
{

    public function index()
    {
        $data = [
            'model' => Auth::user()
        ];
        return view('ordemservico::tecnico.painel.index', compact('data'));
    }

    public function ordensDisponiveis()
    {
        $idStatusConcluida = Status::all()->where('titulo','Serviço executado')->first()->id;
        $idStatusInutilizado = Status::all()->where('titulo','Marcado como Inutilizável')->first()->id;

        $data = [
            'title' => 'Ordens Disponíveis',
            'model' => OrdemServico::where('tecnico_id', null)
            ->where('status_id','<>',$idStatusConcluida)
            ->where('status_id','<>',$idStatusInutilizado)->get(),
            'thead' => ['Protocolo', 'Solicitante', 'Status','Problema','Prioridade'],
            'row_db' => ['protocolo', 'solicitante_id', 'status_id','problema_id','prioridade'],
            'create' => false,
            'acoes' => []
        ];
        return view('ordemservico::tecnico.painel.ordensDisponiveis', compact('data'));
    }

    public function ordensAtivas()
    {
        $idStatusConcluida = Status::all()->where('titulo', 'Serviço executado')->first()->id;
        $idStatusInutilizado = Status::all()->where('titulo', 'Marcado como Inutilizável')->first()->id;
        $data = [
            'title' => 'Minhas Ordens de Serviços',
            'model' => OrdemServico::where('tecnico_id', Auth::user()->id)->where('status_id', '<>', $idStatusConcluida)->where('status_id', '<>', $idStatusInutilizado)->get(),
            'thead' => ['Protocolo', 'Solicitante', 'Status','Problema','Prioridade'],
            'row_db' => ['protocolo', 'solicitante_id', 'status_id','problema_id','prioridade'],
            'create' => false,
            'status' => Status::pluck('titulo', 'id'),
            'route' => 'modulo.tecnico.painel.',
            'acoes' => []
        ];
        return view('ordemservico::tecnico.painel.minhasOS', compact('data'));
    }

    public function pegarResponsabilidade($id)
    {
        $os = OrdemServico::all()->where('protocolo', $id)->first();
        $idEncaminhadaTecnico = Status::all()->where('titulo', 'Encaminhada para o técnico')->first()->id;
        $os->status_id = $idEncaminhadaTecnico;
        $os->tecnico_id = Auth::user()->id;
        $os->save();
        return redirect()->back()->with('success', 'Ordem Ativada com successo');
    }

    public function listarProblemas()
    {
        $data = [
            'model' => Problema::all(),
            'title' => 'Banco de Conhecimento de Soluções',
            'thead' => ['Titulo'],
            'row_db' => ['titulo'],
            'create' => false,
            'route' => 'modulo.tecnico.painel.problemas.',
            'acoes' => [
                ['nome' => 'Ver soluções', 'class' => 'btn btn-outline-info btn-sm', 'complemento-route' => 'solucoes'],
            ]
        ];
        return view('ordemservico::layouts.index', compact('data'));
    }

    public function listarSolucoes($id){
        $data = [
            'problema' => Problema::findOrFail($id),
            'model' => Solucao::all()->where('problema_id',$id),
            'title' => 'Solucoes'
        ];
        return view('ordemservico::tecnico.painel.solucoes',compact('data'));
    }
}
