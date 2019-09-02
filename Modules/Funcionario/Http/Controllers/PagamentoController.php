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
            $pagamento = $this->calcularTotal($pagamento, $request->cargos);
   
            $pagamento->save();
         

            DB::commit();
            return redirect('/funcionario/pagamento')->with('success', "pagamento cadastrado com sucesso");
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', "Erro ao cadastrar pagamento!: cod_erro:" . $e->getMessage());
        }
    }
   
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return "";
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
   

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
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
       
    public function calcularTotal(Pagamento $pagamento, $cargo)
        {
            $total = $pagamento->valor;
            $valor_dia = floatval($pagamento->funcionario->cargos->find($cargo)->salario) / 20; 
            $valor_horas_extras =(floatval($valor_dia) / 8) * floatval($pagamento->horas_extras);
            $horas_dias = floatval($pagamento->funcionario->cargos->find($cargo)->horas_semanais) / 5;
            $desconto = floatval($pagamento->funcionario->cargos->find($cargo)->salario) / 30  * ($pagamento->faltas * $horas_dias );
         
            
            if($pagamento->tipo_pagamento == "2"){
                    $total *= 0.4;
                }
                $total-= $desconto;
               
                $total+= $valor_horas_extras + $pagamento->adicional_noturno;
                $pagamento->total = $total - $pagamento->inss;
             
                return $pagamento;
             // $desconto = $pagamento->salario / 30 * ($pagamento->faltas * $horas_dia);
            /*
            console.log("Valor salario :" + selectedCargo.salario + "hora Extra:" + $('#horas_extras').val() + "Adicional noturno:" + $('.adicional1').val() + " Faltas:" + $('#faltas').val())
            var salario = parseFloat(selectedCargo.salario)
            var horas_extras = parseFloat($('.horas_extras').val())
            var valor_dia = salario / 20
            var horas_dias = parseFloat(selectedCargo.horas_semanais / 5)
            var valor_hora_extra = (valor_dia / 8) * horas_extras
            var adicional = parseFloat($('.adicional1').val())
            var faltas = parseFloat($('.faltas').val())
            var inss = parseFloat($('.inss').val())
            var desconto = salario / 30 * (faltas * horas_dias)

            console.log("desconto:" + -desconto)
            var temp = total;

            //do total ele efetua os descontos e soma os extras
            temp -= desconto
            temp += (valor_hora_extra + adicional)
            */
           // $salario = 

        }

    
}
