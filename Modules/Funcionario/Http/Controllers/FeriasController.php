<?php

namespace Modules\Funcionario\Http\Controllers;

use DateTime;
use DB;
use Gate;
use Auth;
use Illuminate\Http\Request;use Illuminate\Http\Response;use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\ControleFerias;

use Modules\Funcionario\Entities\Ferias;

use Modules\Funcionario\Entities\Funcionario;
use Modules\Funcionario\Http\Requests\CreateFerias;

class FeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (Gate::allows('administrador', Auth::user())) {
            $data = [
                'title' => 'Lista de Funcionários',
                'funcionarios' => Funcionario::all(),
            ];
            return view('funcionario::ferias.index', compact('data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('funcionario::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CreateFerias $request)
    {
        if (Gate::allows('administrador', Auth::user())) {
            DB::beginTransaction();

            try {

                /*Estas linhas fazer com que seja possivel a inversão das datas sem dar problemas,
                só é preciso agora passar o formato no create para salvar no banco.*/
                $inicio_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['inicio_periodo_aquisitivo']);
                $fim_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['fim_periodo_aquisitivo'])->format('Y-m-d');
                $limite_periodo_aquisitivo = DateTime::createFromFormat('d/m/Y', $request['limite_periodo_aquisitivo']);

                //Esta linha verifica se já há algum registro na tabela controle_ferias.
                $verificarRegistroTabela = DB::table('controle_ferias')->where('funcionario_id', '=', $request['funcionario_id'])->count();

                if ($verificarRegistroTabela > 0) { // esse if verifica caso haja pelo menos uma férias cadastrada

                    $saldo_periodo = $request['saldo_periodo'];
                    $saldo_periodo -= $request->dias_ferias;

                } else {
                    $saldo_periodo = $request->saldo_periodo - $request->dias_ferias;
                }

                $controleFerias = ControleFerias::Create([
                    'inicio_periodo_aquisitivo' => $inicio_periodo_aquisitivo->format('Y-m-d'),
                    'fim_periodo_aquisitivo' => $fim_periodo_aquisitivo,
                    'limite_periodo_aquisitivo' => $limite_periodo_aquisitivo->format('Y-m-d'),
                    'saldo_periodo' => $saldo_periodo,
                    'funcionario_id' => $request['funcionario_id'],
                ]);

                if ($request->pagamento_parcela13 == "on") {
                    $pagamento13 = true;
                } else {
                    $pagamento13 = false;
                }

                $ferias = Ferias::Create([
                    'data_inicio' => date('Y-m-d', strtotime($request['data_inicio'])),
                    'data_fim' => date('Y-m-d', strtotime($request['data_fim'])),
                    'dias_ferias' => $request->dias_ferias,
                    'data_pagamento' => date('Y-m-d', strtotime($request['data_pagamento'])),
                    'data_aviso' => date('Y-m-d', strtotime($request['data_aviso'])),
                    'pagamento_parcela13' => $pagamento13,
                    'observacao' => $request['observacao'],
                    'funcionario_id' => $request['funcionario_id'],
                    'controle_ferias_id' => $controleFerias->id,
                ]);

                DB::commit();
                return redirect('funcionario/ferias')->with('success', 'Férias cadastrada com sucesso!');
            } catch (Exception $e) {
                DB::rollback();
                return back();
            }
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $funcionario = Funcionario::findOrFail($id);

            $nome = $funcionario->nome;
            $cargo = $funcionario->cargos()->get()->last()->nome;
            $inicio_periodo_aquisitivo = $funcionario->controle_ferias()->get()->last()->inicio_periodo_aquisitivo;
            $fim_periodo_aquisitivo = $funcionario->controle_ferias()->get()->last()->fim_periodo_aquisitivo;
            $data_inicio = $funcionario->ferias()->get()->last()->data_inicio;
            $data_fim = $funcionario->ferias()->get()->last()->data_fim;

            $carteiraTrabalho = DB::table('funcionario')->join('funcionario_has_documento', 'funcionario_has_documento.funcionario_id', '=', 'funcionario.id')
                ->join('documento', 'documento.id', '=', 'funcionario_has_documento.documento_id')
                ->where([
                    ['funcionario_has_documento.funcionario_id', '=', $funcionario->id],
                    ['documento.tipo_documento_id', '=', '4'],
                ])->get()->last()->numero;

            $serieCarteiraTrabalho = DB::table('funcionario')->join('funcionario_has_documento', 'funcionario_has_documento.funcionario_id', '=', 'funcionario.id')
                ->join('documento', 'documento.id', '=', 'funcionario_has_documento.documento_id')
                ->where([
                    ['funcionario_has_documento.funcionario_id', '=', $funcionario->id],
                    ['documento.tipo_documento_id', '=', '8'],
                ])->get()->last()->numero;

            $data = [
                'nome' => $nome,
                'cargo' => $cargo,
                'inicio_periodo_aquisitivo' => DateTime::createFromFormat('Y-m-d', $inicio_periodo_aquisitivo)->format('d/m/Y'),
                'fim_periodo_aquisitivo' => DateTime::createFromFormat('Y-m-d', $fim_periodo_aquisitivo)->format('d/m/Y'),
                'data_inicio' => DateTime::createFromFormat('Y-m-d', $data_inicio)->format('d/m/Y'),
                'data_fim' => DateTime::createFromformat('Y-m-d', $data_fim)->format('d/m/Y'),
                'carteiraTrabalho' => $carteiraTrabalho,
                'serieCarteiraTrabalho' => $serieCarteiraTrabalho,
            ];

            return view('funcionario::ferias.show', compact('data'));
        }
    }

    public function listar($id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $data = [
                'title' => 'Lista de Funcionários',
                'ferias' => Ferias::where('funcionario_id', '=', $id)->get(),
            ];
            return view('funcionario::ferias.listar', compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $funcionario = funcionario::findorFail($id);
            $ferias = $funcionario->ferias->last();

            $data = [
                'title' => 'Editar Férias',
                'ferias' => Ferias::where('funcionario_id', '=', $id)->get()->last(),
                'saldo_periodo' => ControleFerias::where('funcionario_id', '=', $id)->get()->last()->saldo_periodo,
            ];

            return view('funcionario::ferias.editaFerias', compact('data'));
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        if (Gate::allows('administrador', Auth::user())) {
            if ($request->pagamento_parcela13 == "on") {
                $pagamento13 = true;
            } else {
                $pagamento13 = false;
            }

            //Esta query pega o ultimo saldo disponível do periodo
            $saldo_periodo = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_periodo;

            //Esta variável armazena o valor no campo de dias que o usuário digitou na tela
            $dias_ferias_inseridos = $request->dias_ferias;

            //Esta guarda o valor que já está cadastada no banco os dias de férias marcados.
            $dias_ferias_banco = Ferias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->dias_ferias;

            /*O if verifica se os dias que o usuário digitou são maiores do que está guardado no banco, caso for,
            ele pega o saldo e subtrai da diferença dos dias inseridos com os ja cadastrados no banco (pois o novo saldo será menor que o cadastrado), senão,
            o saldo_periodo é somado com a diferença entre os dias de férias ja cadastrado no banco com os nvoos dias inseridos (o novo saldo será maior que o cadastrado anteriormente)*/
            if ($dias_ferias_inseridos > $dias_ferias_banco) {
                $saldo_periodo = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_periodo - ($dias_ferias_inseridos - $dias_ferias_banco);

            } else {
                $saldo_periodo = ControleFerias::where('funcionario_id', '=', $request['funcionario_id'])->get()->last()->saldo_periodo + ($dias_ferias_banco - $dias_ferias_inseridos);

            }

            DB::beginTransaction();

            try {

                $ferias = Ferias::findOrFail($id);
                $controleFerias = ControleFerias::findOrFail($id);

                $controleFerias->update(['saldo_periodo' => $saldo_periodo]);

                $ferias->update([
                    'data_inicio' => date('Y-m-d', strtotime($request['data_inicio'])),
                    'data_fim' => date('Y-m-d', strtotime($request['data_fim'])),
                    'dias_ferias' => $request->dias_ferias,
                    'data_pagamento' => date('Y-m-d', strtotime($request['data_pagamento'])),
                    'data_aviso' => date('Y-m-d', strtotime($request['data_aviso'])),
                    'situacao_ferias' => $request['situacao_ferias'],
                    'pagamento_parcela13' => $pagamento13,
                    'observacao' => $request['observacao'],
                    'funcionario_id' => $request['funcionario_id'],
                    'controle_ferias_id' => $ferias->id,
                ]);

                DB::commit();

                return redirect('funcionario/ferias')->with('success', 'Férias atualizada com sucesso');
            } catch (Exception $e) {
                DB::rollback();
                return $e;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */

    public function indexRelatorio()
    {

        return view('funcionario::ferias.indexRelatorio');
    }

    public function listRelatorio(Request $request)
    {
        if (Gate::allows('administrador', Auth::user())) {
            $dataInicio = $request->data_inicio;
            $dataFim = $request->data_fim;

            $dadosRelatorio = DB::table('funcionario')->join('ferias', 'funcionario.id', '=', 'ferias.funcionario_id')
                ->join('pagamento', 'funcionario.id', '=', 'pagamento.funcionario_id')
                ->where([
                    ['data_inicio', '>=', $dataInicio],
                    ['data_fim', '<=', $dataFim],
                    ['tipo_pagamento', '=', 'ferias'],
                ])->select('funcionario.nome', 'ferias.data_inicio', 'ferias.data_fim', 'pagamento.total')->get();

            if ($dadosRelatorio->count() > 0) {
                return view('funcionario::ferias.listRelatorio', compact('dadosRelatorio'));
            } else {
                return redirect()->back()->with('error', 'Não há férias ou pagamentos para o período selecionado.');
            }
        }

    }

    public function destroy($id)
    {
        //
    }
}
