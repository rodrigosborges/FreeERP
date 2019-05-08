<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities \ {
    OrdemServico,
    Solicitante,
    Tecnico
};
use DB;

class OrdemServicoController extends Controller
{

    protected $moduleInfo;
    protected $menu;

    //construtor para amarzenar irnformações do menu que será enviada para todas as views desse controller
    public function __construct()
    {
        $this->moduleInfo = [
            'icon' => 'settings',
            'name' => 'Ordem de Serviço',
        ];
        $this->menu = [
            ['icon' => 'add_box', 'tool' => 'Gerenciar OS', 'route' => 'os'],
            ['icon' => 'add_box', 'tool' => 'Gerenciar técnico', 'route' => 'tecnico'],
        ];
    }

    public function index(Request $request)
    {
        //setando o menu
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        //se houver um request de busca é retornado para a view index os resultados , senão envia todo os dados da tabela
        if ($request->has('busca')) {
            $busca = $request->get('busca');
            $data = [
                'title' => 'Ordem ',
                'ordem_servico' => OrdemServico::where('id', 'like', "%{$busca}%")
                    ->orWhere('marca', 'like', "%{$busca}%")
                    ->orWhere('tipo_aparelho', 'like', "%{$busca}%")
                    ->orWhere('descricao_problema', 'like', "%{$busca}%")
                    ->orWhere('numero_serie', 'like', "%{$busca}%")
                    ->orWhere('solicitante_id', 'like', "%{$busca}%")
                    ->paginate(5)
            ];
            $data['ordem_servico']->appends(['busca' => $busca]);
            return view('ordemservico::ordemservico.index', compact('data', 'busca', 'moduleInfo', 'menu'));
        } else {
            $data = [
                'title' => 'Ordem de servico',
                'ordem_servico' => OrdemServico::paginate(5)
            ];
        }
        return view('ordemservico::ordemservico.index', compact('data', 'moduleInfo', 'menu'));
    }

    public function create()
    {

        //setando o menu
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'url' => url("ordemservico/os"),
            'model' => '',
            'solicitante' => Solicitante::all(),
            'title' => 'Cadastro de OS',
            'button' => 'Salvar'
        ];
        return view('ordemservico::ordemservico.form', compact('data', 'moduleInfo', 'menu'));
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $ordem_servico = OrdemServico::create($request->all());
            DB::commit();
            return redirect('/ordemservico/os')->with('success', 'Ordem cadastrada com successo');
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function show($id)
    {

        //setando o menu
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
            'url' => url("ordemservico/os/$id"),
            'model' =>  OrdemServico::findOrFail($id),
            'solicitante' => Solicitante::all(),
            'title' => 'Atualização de OS',
            'button' => 'Atualizar'
        ];
        return view('ordemservico::ordemservico.show', compact('data', 'moduleInfo', 'menu'));
    }
    public function edit($id)
    {
        //setando o menu
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $data = [
            'url' => url("ordemservico/os/$id"),
            'model' =>  OrdemServico::findOrFail($id),
            'solicitante' => Solicitante::all(),
            'title' => 'Atualização de OS',
            'button' => 'Atualizar'
        ];

        return view('ordemservico::ordemservico.form', compact('data', 'moduleInfo', 'menu'));
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
