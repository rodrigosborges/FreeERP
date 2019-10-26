<?php

namespace Modules\OrdemServico\Http\Controllers;

use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Modules\OrdemServico\Entities\{
    Solicitante,
    Endereco,
    Estado,
    OrdemServico,
    Aparelho,
    Cidade,
    Problema,
    Status,
    Telefone
};
use DB;
use Illuminate\Support\Facades\Mail;
use Modules\OrdemServico\Emails\EnviarProtocoloMail;

class OrdemServicoController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Administração de Ordem de Servico',
            'model' => OrdemServico::all(),
            'thead' => ['Protocolo', 'Solicitante', 'Status'],
            'row_db' => ['protocolo', 'solicitante_id', 'status_id'],
            'create' => true,
            'status' => Status::pluck('titulo','id'),
            'route' => 'modulo.os.',
            'acoes' => [
                ['nome' => 'Editar', 'class' => 'btn btn-outline-info btn-sm', 'complemento-route' => 'edit'],
                ['nome' => 'Detalhes', 'class' => 'btn btn-outline-warning btn-sm', 'complemento-route' => 'show'],
                ['nome' => 'PDF', 'class' => 'btn btn-outline-dark btn-sm', 'complemento-route' => 'pdf']
            ]
        ];
        return view('ordemservico::ordemservico.index', compact('data'));
    }

    public function create()
    {

        if (Gate::allows('administrador', Auth::user())) {
            $data = [
                'estado' => Estado::pluck('abreviacao', 'id'),
                'cidade' => Cidade::orderBy('nome', 'ASC')->pluck('nome', 'id'),
                'status' => Status::pluck('titulo', 'id'),
                'url' => url("ordemservico/os"),
                'solicitante' => Solicitante::all(),
                'title' => 'Abrir de OS',
                'button' => 'Salvar'
            ];
            return view('ordemservico::ordemservico.formulario.form-completo', compact('data'));
        }

        return redirect()->back()->with('error', 'Você não possui permissão para acessar a pagina!');
    }
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $aparelho = Aparelho::firstOrCreate($request->aparelho)->id;
            $problema = Problema::firstOrCreate($request->problema)->id;
            $endereco = Endereco::create($request->endereco)->id;
            $solicitante = Solicitante::firstOrCreate([
                'id' =>  $request->solicitante['id'],
                'nome' =>  $request->solicitante['nome'],
                'email' =>  $request->solicitante['email'],
                'endereco_id' => $endereco
            ]);
            $solicitante->telefones()->createMany($request->telefone);
           
            $ordem_servico = OrdemServico::create(
                [
                    'solicitante_id' => $solicitante->id,
                    'aparelho_id' => $aparelho,
                    'problema_id' => $problema,
                    'descricao' => $request->descricao,
                    'gerente_id' => Auth::user()->id,
                    'protocolo' => uniqid(),
                ]
            );

            DB::commit();
            Mail::to($solicitante->email)->send(new EnviarProtocoloMail($ordem_servico));
            return redirect('/ordemservico/os')->with('success', 'Ordem aberta com sucesso!');
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

        if (Gate::allows('administrador', Auth::user())) {
            $data = [
                'url' => url("ordemservico/os/$id"),
                'model' =>  OrdemServico::findOrFail($id),
                'acessorios' => explode(",", OrdemServico::findOrFail($id)->aparelho->acessorios),
                'solicitante' => Solicitante::all(),
                'title' => 'Atualização de OS',
                'button' => 'Atualizar'
            ];

            return view('ordemservico::ordemservico.formulario.form-completo', compact('data'));
        } else {
            return redirect()->back()->with('error', 'Você não possui permissão para acessar a pagina!');
        }
    }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $ordem_servico = OrdemServico::findOrFail($id);
            $aparelho = Aparelho::firstOrCreate($request->aparelho)->id;
            $problema = Problema::firstOrCreate($request->problema)->id;

            $ordem_servico->update(
                [
                    'aparelho_id' => $aparelho,
                    'problema_id' => $problema,
                    'descricao' => $request->descricao
                ]
            );
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

    public function pdf($id)
    {
        $data = [
            'model' => OrdemServico::findOrFail($id),
        ];
        //constrói um pdf da view carregada no método loadView
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('ordemservico::ordemservico.pdf', compact('data'));
        return $pdf->stream();
    }

}
