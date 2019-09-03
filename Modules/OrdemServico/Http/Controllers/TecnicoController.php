<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    Tecnico
};
use DB;

class TecnicoController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Administração de Tecnicos',
            'model' => Tecnico::paginate(5),
            'inativos' => Tecnico::onlyTrashed()->get(),
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('tecnico'),0,5),
            'cadastro' => 'Cadastrar Tecnico',
            'deletar' => true,
            'route' => 'modulo.tecnico.',
            'acoes' => [
                ['nome' => 'Editar' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'edit'],
                ['nome' => 'Acessar' , 'class' =>'btn btn-outline-warning btn-sm','complemento-route' => 'painel.index'],
                ]
            ];

        return view('ordemservico::layouts.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'url' => url("ordemservico/tecnico"),
            'title' => 'Cadastro de Técnico',
            'button' => 'Salvar'
        ];
        return view('ordemservico::tecnico.form', compact('data'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $tecnico = Tecnico::create($request->all());
            DB::commit();
            return redirect('/ordemservico/tecnico')->with('success', 'Tecnico cadastrado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function show($id)
    {
        return view('ordemservico::show');
    }

    public function edit($id)
    {
        $data = [
            'url' => url("ordemservico/tecnico/$id"),
            'model' =>  Tecnico::findOrFail($id),
            'title' => 'Atualização de Técnico',
            'button' => 'Atualizar'
        ];

        return view('ordemservico::tecnico.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $tecnico = Tecnico::findOrFail($id);
            $tecnico->update($request->all());
            DB::commit();
            return redirect('/ordemservico/tecnico')->with('success', 'Tecnico atualizado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function destroy($id)
    {
        $tecnico = Tecnico::withTrashed()->findOrFail($id);
        if ($tecnico->trashed()) {
            $tecnico->restore();
            return back()->with('success', 'Técnico ativado com sucesso!');
        } else {
            $tecnico->delete();
            return back()->with('success', 'Técnico desativada com sucesso!');
        }
    }
}
