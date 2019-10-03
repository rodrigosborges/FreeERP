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
        if(isset($request->search) || $request->search != ""){
            $funcionarios = Funcionario::where('nome', 'like', '%'.$request->search.'%')->get();
        }else{
            $funcionarios = Funcionario::all();
        }

        $data = [
            'title'         => "Pagamentos",
            'url' => url('funcionario/pagamento/create'),
            'funcionarios' => $funcionarios,
        ];

        //$pagamentos = Pagamento::paginate(5);

        return view('funcionario::pagamentos.index', compact('data'));
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

    public function novoPagamento($id){
        $funcionario = Funcionario::findOrFail($id);
        $data = [
            "url"   => url('funcionario/pagamento'),
            "button" => 'Salvar',
            "model" => null,
            "title" => "Cadastrar Pagamento",
            'pagamento'=>null,
            'funcionarios' =>Funcionario::findOrFail($id)->get(),
            'cargo'=> $funcionario->cargos->last()
        ];
        

        return view('funcionario::pagamentos.form', compact('data','funcionario'));
    }


    public function listar($id, Request $request)
    {   
        if(isset($request->search) || $request->search != ""){
            $from= $request->search." 00:00:00";
            $to= $request->search." 23:59:59";
            $pagamentos = Pagamento::
            where('funcionario_id', '=', $id)
            ->whereBetween('created_at', array($from, $to))->get();

            // DB::enableQueryLog(); // Enable query log
            // // Your Eloquent query
            // dd(DB::getQueryLog($pagamentos = Pagamento::
            // where('funcionario_id', '=', $id)
            // ->whereBetween('created_at', array($from, $to))->get()));
                
                
        }else{
            $pagamentos = Pagamento::where('funcionario_id','=',$id)->get();
        }
        $data = [
            'title' => 'Lista de Pagamentos',
            'pagamentos' => $pagamentos,
        ];
       
        return view('funcionario::pagamentos.listar', compact('data'));
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
            $pagamento->tipo_hora_extra = $request->tipo_hora_extra;
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
            $pagamento = $this->calcularTotal($pagamento, $salario);
           // dd($pagamento);
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
        $data = [
            'title' => 'Holerite',
            'pagamento' => Pagamento::findOrFail($id)
        ];

        return view('funcionario::pagamentos.show', compact('data'));
        
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
            'url' => url('funcionario/pagamento/'.$id ),
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
     *///Autor: Denise Lopes
    public function update(Request $request, $id)
    {

        DB::beginTransaction();
        
        try {
            $pagamento = Pagamento::findOrFail($id);
            $funcionario = Funcionario::findOrFail($request->funcionario);

            $salario = floatval($funcionario->cargos->find($request->cargos)->salario);
            $salario = str_replace(',','.', $salario);
            $pagamento->valor = $salario;
            $pagamento->faltas = $request->faltas;
            $pagamento->horas_extras = $request->horas_extras;
            $pagamento->adicional_noturno = $request->adicional;
            $pagamento->tipo_hora_extra = $request->tipo_hora_extra;
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
            $pagamento = $this->calcularTotal($pagamento, $salario);
           // dd($pagamento);
            $pagamento->save();
         
            DB::commit();
            return redirect('/funcionario/pagamento')->with('success', "pagamento atualizado com sucesso");
        } catch (Exception $e) {
            DB::rollback();
            return redirect()->back()->with('danger', "Erro ao atualizar o pagamento!: cod_erro:" . $e->getMessage());
        }
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
    public function buscaCargo(Request $request)
    {


        $funcionario = Funcionario::findOrFail($request->id);
        
        return json_encode($funcionario->cargos->last());
    }

    public function buscaSalario(Request $request)
    {
        
        $cargo = Cargo::find($request->id);
        if ($cargo != null) {

            return $cargo;
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
       
    public function calcularTotal(Pagamento $pagamento, $salario){
            $total = $pagamento->valor;
            //horas Extras
            if($pagamento->tipo_hora_extra == 1){
                $horas_extras = ($salario/220)*2;
                $horas_extras *= $pagamento->horas_extras;
            }else{
                $horas_extras = ($salario/220)*1.5;
                $horas_extras *= $pagamento->horas_extras;
            }

            //add noturno
            $add_noturno = ($salario/220)*0.2;
            $add_noturno *= $pagamento->adicional_noturno;

            
            //faltas
            $faltas = ($salario/30)*$pagamento->faltas;


            if($pagamento->tipo_pagamento == "2"){
                $total *= 0.4;
            }

            $total+= $horas_extras + $add_noturno;
            $pagamento->total = $total - $pagamento->inss - $faltas ;
            
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
