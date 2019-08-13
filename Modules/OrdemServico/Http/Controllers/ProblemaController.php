<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    Problema
};
use DB;

class ProblemaController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Listagem de Problemas',
            'model' => Problema::paginate(5),
            'inativos' => Problema::onlyTrashed()->get(),
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('problema'),0,5),
            'route' => 'modulo.problema.',
            'cadastro' => '',
            'acoes' => [
                ['nome' => 'Prioridade' , 'class'=>'btn btn-outline-info btn-sm' , 'complemento-route' => 'index']],
               
        ];

        return view('ordemservico::layouts.index', compact('data'));
    }
    
    public function showAjax(){
        $dados = Problema::all();

        return response()->json($dados);
    }

    public function create()
    {
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $problema = Problema::create($request->problema());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
    }

    public function show($id)
    {
    }
 
    public function edit($id)
    {
    }
 
    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
        $problema = Problema::withTrashed()->findOrFail($id);
        if ($problema->trashed()) {
            $problema->restore();
            return back()->with('success', 'Problema ativado com sucesso!');
        } else {
            $problema->delete();
            return back()->with('success', 'Problema desativado com sucesso!');
        }
    }
   
}

