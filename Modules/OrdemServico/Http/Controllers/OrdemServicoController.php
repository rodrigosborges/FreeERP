<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Entities\Relacao;
use Modules\OrdemServico\Entities \ {
    OrdemServico,
    Solicitante,
    Tecnico,
    Aparelho,
    Problema
};
use DB;
use Hamcrest\Core\HasToString;

class OrdemServicoController extends Controller
{

    public function index(Request $request)
    {   
        $data = [
            'title' => 'Administração de Ordem de Servico',
            'model' => OrdemServico::paginate(5),
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('ordem_servico'),0,4),
            'cadastro' => 'Cadastrar OS',
            'route' => 'modulo.os.',
            'acoes' => [
                ['nome' => 'Editar' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'edit'],
                ['nome' => 'Detalhes' , 'class' =>'btn btn-outline-warning btn-sm','complemento-route' => 'show'],
                ['nome' => 'Prioridade' , 'class'=>'btn btn-outline-info btn-sm' , 'complemento-route' => 'index'],
                ['nome' => 'PDF' , 'class' =>'btn btn-outline-dark btn-sm', 'complemento-route' => 'pdf']
                ]
            ];
        return view('ordemservico::layouts.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'url' => url("ordemservico/os"),
            'model' => '',
            'solicitante' => Solicitante::all(),
            'title' => 'Cadastro de OS',
            'button' => 'Salvar'
        ];
        return view('ordemservico::ordemservico.form', compact('data'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            
            $aparelho = Aparelho::firstOrCreate($request->aparelho)->id;
            $problema = Problema::firstOrCreate($request->problema)->id;
            
            $ordem_servico = OrdemServico::create(
                ['solicitante_id' => $request->solicitante['solicitante_id'],
                'aparelho_id' => $aparelho,
                'problema_id' => $problema,
                'descricao' => $request->ordem_servico['descricao']]
            );        
    
            DB::commit();
            return redirect('/ordemservico/os')->with('success', 'Ordem cadastrada com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function show($id)
    {
        $data = [
            'model' =>  OrdemServico::findOrFail($id),
            'title' => 'Detalhes de OS',
        ];
        return view('ordemservico::ordemservico.show', compact('data'));
    }
    public function edit($id)
    {
        $data = [
            'url' => url("ordemservico/os/$id"),
            'model' =>  OrdemServico::findOrFail($id),
            'solicitante' => Solicitante::all(),
            'title' => 'Atualização de OS',
            'button' => 'Atualizar'
        ];

        return view('ordemservico::ordemservico.form', compact('data'));
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $ordem_servico = OrdemServico::findOrFail($id);
            $ordem_servico->update($request->all());
            DB::commit();
            return redirect('/ordemservico/os')->with('success', 'Item atualizado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function destroy($id)
    {
        $ordem_servico = OrdemServico::withTrashed()->findOrFail($id);
        if ($ordem_servico->trashed()) {
            $ordem_servico->restore();
            return back()->with('success', 'Ordem ativado com sucesso!');
        } else {
            $ordem_servico->delete();
            return back()->with('success', 'Ordem desativada com sucesso!');
        }
    }

    public function pdf()
    {
        //constrói um pdf da view carregada no método loadView
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('ordemservico::ordemservico.pdf');
        return $pdf->stream();
    }
   
}

