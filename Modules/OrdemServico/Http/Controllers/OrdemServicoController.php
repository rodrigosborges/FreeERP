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
use Modules\OrdemServico\Http\Requests\OrdemServicoStoreRequest;

class OrdemServicoController extends Controller
{
    public function index(Request $request)
    {

        if (Gate::allows('administrador', Auth::user())) {
            $idStatusConcluida = Status::all()->where('titulo', 'Concluída')->first()->id;
            $idStatusInutilizado = Status::all()->where('titulo', 'Marcado como Inutilizável')->first()->id;

            $ordensConcluidas = DB::table('ordem_servico')->where('status_id', $idStatusConcluida);
            $data = [
                'title' => 'Administração de Ordem de Servico em Andamento',
                'model' => OrdemServico::all()->where('status_id', '<>', $idStatusConcluida)->where('status_id', '<>', $idStatusInutilizado),
                'thead' => ['Protocolo', 'Solicitante', 'Status', 'Prioridade'],
                'row_db' => ['protocolo', 'solicitante_id', 'status_id', 'prioridade'],
                'create' => true,
                'principaisFalhas' => DB::table('ordem_servico')
                    ->join('problema', 'problema.id', '=', 'ordem_servico.problema_id')
                    ->select(DB::raw('count(*) as total, problema.titulo'))
                    ->limit(3)
                    ->orderBy('total', 'desc')
                    ->groupBy('problema.titulo')
                    ->get(),
                'inutilizadosAno' => DB::table('aparelho')->where('inutilizacao', true)->whereYear('updated_at', date('Y')),
                'inutilizadosMes' => DB::table('aparelho')->where('inutilizacao', true)->whereMonth('updated_at', date('m'))->whereYear('updated_at', date('Y')),
                'tempoMedio' => (DB::select("select avg(timediff(updated_at,created_at)) as media from ordem_servico where status_id =" . $idStatusConcluida)),
                'ordensConcluidas' => $ordensConcluidas->whereMonth('updated_at', date('m'))->count(),
                'status' => Status::pluck('titulo', 'id'),
                'route' => 'modulo.os.',
                'acoes' => [
                    ['nome' => 'Editar', 'class' => 'btn btn-outline-info btn-sm', 'complemento-route' => 'edit'],
                    ['nome' => 'Detalhes', 'class' => 'btn btn-outline-warning btn-sm', 'complemento-route' => 'show'],
                    ['nome' => 'PDF', 'class' => 'btn btn-outline-dark btn-sm', 'complemento-route' => 'pdf']
                ]
            ];
            return view('ordemservico::ordemservico.index', compact('data'));
        }
        return redirect()->back()->with('error', 'Você não possui permissão para acessar a pagina!');
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
    public function store(OrdemServicoStoreRequest $request)
    {
        DB::beginTransaction();
        try {
            $aparelho = Aparelho::firstOrCreate(['numero_serie' => $request->aparelho['numero_serie']], $request->aparelho)->id;
            $problema = Problema::firstOrCreate($request->problema)->id;
            $endereco = Endereco::create($request->endereco)->id;
            $solicitante = Solicitante::updateOrCreate(
                ['identificacao' =>  $request->solicitante['id']],
                [
                    'identificacao' =>  $request->solicitante['id'],
                    'nome' =>  $request->solicitante['nome'],
                    'email' =>  $request->solicitante['email'],
                    'endereco_id' => $endereco

                ]
            );
            DB::table('telefone')->where('solicitante_id', $solicitante->id)->delete();

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
            $aparelho = Aparelho::firstOrCreate(['numero_serie' => $request->aparelho['numero_serie']], $request->aparelho)->id;
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

    public function updatePrioridade(Request $request, $id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            DB::beginTransaction();
            try {
                $os = OrdemServico::all()->where('protocolo', $id)->first();
                $os->update($request->all());
                DB::commit();
                return redirect('/ordemservico/os')->with('success', 'Prioridade atualizada com successo');
            } catch (Exception $e) {
                DB::rollback();
                return back()->with('error', 'Erro no servidor');
            }
        }
        return redirect()->back()->with('error', 'Você não possui permissão para acessar a pagina!');
    }

    public function ordensFinalizadas(Request $request)
    {

        if (Gate::allows('administrador', Auth::user())) {
            $idStatusConcluida = Status::all()->where('titulo', 'Concluída')->first()->id;
            $idStatusInutilizado = Status::all()->where('titulo', 'Marcado como Inutilizável')->first()->id;
            $data = [
                'title' => 'Ordens Finalizadas',
                'model' => OrdemServico::where('status_id', '=', $idStatusConcluida)
                    ->orWhere('status_id', '=', $idStatusInutilizado)
                    ->get(),
                'thead' => ['Protocolo', 'Solicitante', 'Status', 'Prioridade'],
                'row_db' => ['protocolo', 'solicitante_id', 'status_id', 'prioridade'],
                'create' => false,
                'route' => 'modulo.os.',
                'acoes' => [
                    ['nome' => 'Detalhes', 'class' => 'btn btn-outline-warning btn-sm', 'complemento-route' => 'show'],
                ]
            ];
            return view('ordemservico::layouts.index', compact('data'));
        }
        return redirect()->back()->with('error', 'Você não possui permissão para acessar a pagina!');
    }

    public function showAparelho(Request $request)
    {
        $dados = Aparelho::where('numero_serie', $request->numero_serie)->firstOrFail();
        return response()->json($dados);
    }

    public function showProblemas()
    {
        $dados = Problema::all();
        return response()->json($dados);
    }
}
