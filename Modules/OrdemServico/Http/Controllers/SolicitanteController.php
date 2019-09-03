<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities\{
    Solicitante
};
use DB;
use Hamcrest\Core\HasToString;

class SolicitanteController extends Controller
{

    public function index(Request $request)
    {
        $data = [
            'title' => 'Administração de Solicitantes',
            'model' => Solicitante::paginate(5),
            'inativos' => Solicitante::onlyTrashed()->get(),
            'atributos' => array_slice(DB::getSchemaBuilder()->getColumnListing('solicitante'), 0, 5),
            'cadastro' => 'Cadastrar Solicitante',
            'deletar' => true,
            'route' => 'modulo.solicitante.',
            'acoes' => [
                ['nome' => 'Editar', 'class' => 'btn btn-outline-info btn-sm', 'complemento-route' => 'edit'],
            ]
        ];

        return view('ordemservico::layouts.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'url' => url("ordemservico/solicitante"),
            'title' => 'Cadastro de Solicitante',
            'button' => 'Salvar'
        ];

        return view('ordemservico::solicitante.form', compact('data'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $solicitante = Solicitante::create($request->all());
            DB::commit();
            return redirect($request->url)->with('success', 'Solicitante cadastrado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function show($id)
    { }

    public function edit($id)
    {
        $data = [
            'url' => url("ordemservico/solicitante/$id"),
            'model' =>  Solicitante::findOrFail($id),
            'title' => 'Atualização de Solicitante',
            'button' => 'Atualizar'
        ];

        return view('ordemservico::solicitante.form', compact('data'));
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $solicitante = Solicitante::findOrFail($id);
            $solicitante->update($request->all());
            DB::commit();
            return redirect('/ordemservico/solicitante')->with('success', 'Solicitante atualizado com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function destroy($id)
    {
        $solicitante = Solicitante::withTrashed()->findOrFail($id);
        if ($solicitante->trashed()) {
            $solicitante->restore();
            return back()->with('success', 'Solicitante ativado com sucesso!');
        } else {
            $solicitante->delete();
            return back()->with('success', 'Solicitante desativado com sucesso!');
        }
    }
}
