<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Pagamento, Funcionario, Cargo};
use DB;

class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        $data = [

            'title'         => "Pagamentos",
            'url' => url('funcionario/pagamento/create'),
           
        ];
$pagamentos = Pagamento::paginate(5);
        return view('funcionario::pagamentos.index', compact('data','pagamentos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $data = [
            "url"   => url('funcionario/pagamento'),
            "button" => 'Salvar',
            "model" => null,
            "title" => "Cadastrar Pagamento",
            'pagamento'=>null,
            'funcionarios'=>Funcionario::all(),
            

        ];
        

        return view('funcionario::pagamentos.form', compact('data'));

        /* $data = [

            "url" 	 	=> url('funcionario/pagamento'),
            "button" 	=> "Salvar",
            "model"		=> null,
            'title'		=> "Cadastrar Pagamento"
        ];
        $funcionario = Funcionario::findOrFail($request->funcionario);

        $cargo = Cargo::all();
       
        return view('funcionario::pagamentos.form', compact('data','funcionario','cargo')); */
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $pagamento = new Pagamento;
            $funcionario = Funcionario::findOrFail($request->funcionario);
            $salario = floatval($funcionario->cargos->find($request->cargos)->salario);
            $salario = str_replace(',','.', $salario);
            $pagamento->valor = $salario;
            $pagamento->faltas = $request->faltas;
            $pagamento->horas_extras = $request->horas_extras;
            $pagamento->adicional_noturno = $request->adicional;
            $inss= $this->calcularInss($salario);
            if ($request->opcao_pagamento == "2") {
                $temp = $salario * 0.4;
                $pagamento->inss = $this->calcularInss($temp);
                $pagamento->valor *= 0.4;
            } else
                $pagamento->inss = $inss;

            $pagamento->emissao = brToEnDate($request->emissao);
            $pagamento->tipo_pagamento = $_POST['opcao-pagamento'];
            $pagamento->funcionario_id = $funcionario->id;
            $pagamento =$this->OpcaoPagamentoNome($pagamento);

            $pagamento->save();
         

            DB::commit();
            return redirect('/funcionario/pagamento')->with('success', "pagamento cadastrado com sucesso");
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', "Erro ao cadastrar pagamento!: cod_erro:" . $e->getMessage());
        }
    }
    public function teste($var)
    {
        $var = "deu certo";
        return json_encode($var);
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return "coco";
        return view('funcionario::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = [
            "button" => 'Atualizar',
            'title'         => "Editar pagamentos",
            'url' => url('funcionario/pagamento/'.$id .'/edit'),
            'pagamento' => Pagamento::findOrFail($id),
            'funcionarios'=>Funcionario::all(),
        ];
    
        
        return view('funcionario::pagamentos.form', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    //Autor: Denise Lopes
    //método que realiza a busca dos cargos de um determinado funcionario
    public function buscaCargo(Request $request)
    {


        $funcionario = Funcionario::findOrFail($request->id);

        return json_encode($funcionario->cargos);
    }

    public function buscaSalario(Request $request)
    {
        $cargo = Cargo::find($request->id);
        if ($cargo != null) {


            $salario = $cargo->salario;
            return $salario;
        }
        return null;
    }


    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function calcularInss($salario)
    {
        $formula = ($salario * 8) / 100;

        if ($salario <= 1751.81) {
            $inss = $formula;
        } else if (data > 1751.81) {
            $inss = ($salario * 9) / 100;;
        } else {
            $inss = ($salario * 12) / 100;
        }
        return $inss;
    }

    public function OpcaoPagamentoNome(Pagamento $p)
    {
        switch($p->tipo_pagamento){
            case 1: 
            $p->tipo_pagamento = "Salário";
            break;
            case 2:
            $p->tipo_pagamento = "Adiantamento";
            break;
            case 3:
            $p->tipo_pagamento = "Ferias";
            break;
            default:$p->tipo_pagamento = "Outro";
            break;
        }
        return $p;
        


    }
}
