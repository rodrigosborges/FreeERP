<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    OrdemServico,
    Tecnico
};
use DB;

class TecnicoController extends Controller
{
    public function index(Request $request)
    {
        //se houver um request de busca é retornado para a view index os resultados , senão envia todo os dados da tabela
        if ($request->has('busca')) {
            $busca = $request->get('busca');
            $data = [
                'title' => 'Técnico ',
                'tecnico' => Tecnico::where('id', 'like', "%{$busca}%")
                    ->orWhere('nome', 'like', "%{$busca}%")
                    ->orWhere('cpf', 'like', "%{$busca}%")
                    ->orWhere('rg', 'like', "%{$busca}%")
                    ->orWhere('comissao', 'like', "%{$busca}%")
                    ->orWhere('email', 'like', "%{$busca}%")
                    ->paginate(5)
            ];
            $data['tecnico']->appends(['busca' => $busca]);
            return view('ordemservico::tecnico.index', compact('data', 'busca'));
        } else {
            $data = [
                'title' => 'Técnico',
                'tecnico' => Tecnico::paginate(5)
            ];
        }
        return view('ordemservico::tecnico.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'url' => url("ordemservico/tecnico"),
            'model' => '',
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
