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
    
    protected $moduleInfo;
    protected $menu;

    public function __construct()
    {
        $this->moduleInfo = [
            'icon' => 'settings',
            'name' => 'Ordem de Serviço',
        ];
        $this->menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
        ];
    }

    public function index(Request $request)
    {   
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

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
            return view('ordemservico::tecnico.index', compact('data', 'busca', 'moduleInfo', 'menu'));
        } else {
            $data = [
                'title' => 'Técnico',
                'tecnico' => Tecnico::paginate(5)
            ];
        }
        return view('ordemservico::tecnico.index', compact('data', 'moduleInfo', 'menu'));
    }

    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'url' => url("ordemservico/tecnico"),
            'model' => '',
            'title' => 'Cadastro de Técnico',
            'button' => 'Salvar'
        ];
        return view('ordemservico::tecnico.form', compact('data', 'moduleInfo', 'menu'));
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
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
            'url' => url("ordemservico/tecnico/$id"),
            'model' =>  Tecnico::findOrFail($id),
            'title' => 'Atualização de Técnico',
            'button' => 'Atualizar'
        ];

        return view('ordemservico::tecnico.form', compact('data', 'moduleInfo', 'menu'));
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
