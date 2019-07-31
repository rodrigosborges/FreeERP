<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities\{
    Gerente
};
use DB;

class GerenteController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Administração de Gerentes',
            'model' => Gerente::paginate(5),
            'atributos' => DB::getSchemaBuilder()->getColumnListing('gerente'),
            'cadastro' => 'Cadastrar Gerente',
            'route' => 'modulo.gerente.',
            'acoes' => [
                ['nome' => 'Editar' , 'class' => 'btn btn-outline-info btn-sm','complemento-route' => 'edit'],
                ]
            ];

        return view('ordemservico::layouts.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'url' => url("ordemservico/gerente"),
            'model' => '',
            'title' => 'Cadastro de Gerente',
            'button' => 'Salvar'
        ];
        return view('ordemservico::gerente.form', compact('data'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $gerente = Gerente::create($request->all());
            DB::commit();
            return redirect('/ordemservico/gerente')->with('success', 'Gerente cadastrado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $data = [
            'url' => url("ordemservico/gerente/$id"),
            'model' =>  Gerente::findOrFail($id),
            'title' => 'Atualização de Gerente',
            'button' => 'Atualizar'
        ];

        return view('ordemservico::gerente.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $gerente = Gerente::findOrFail($id);
            $gerente->update($request->all());
            DB::commit();
            return redirect('/ordemservico/gerente')->with('success', 'Gerente atualizado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function destroy($id)
    {
        $gerente = Gerente::withTrashed()->findOrFail($id);
        if ($gerente->trashed()) {
            $gerente->restore();
            return back()->with('success', 'Gerente ativado com sucesso!');
        } else {
            $gerente->delete();
            return back()->with('success', 'Gerente desativado com sucesso!');
        }
    }
}
