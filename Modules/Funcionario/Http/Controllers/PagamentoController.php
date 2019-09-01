<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Pagamento, Funcionario, Cargo};


class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {

        $data = [

            'funcionarios' => Funcionario::paginate(10),
            'title'         => "Pagamentos",
            'url' => 'funcionario/pagamento/create',
        ];

        return view('funcionario::pagamentos.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request)
    {
        $data = [
            "url"   => 'funcionario/pagamento',
            "button" => 'Salvar',
            "model" => null,
            "title" => "Cadastrar Pagamento"

        ];
        $funcionarios = Funcionario::all();
        $funcionario = Funcionario::findOrFail(2);

        return view('funcionario::pagamentos.form', compact('data', 'funcionarios'));

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
        //

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
        return view('funcionario::edit');
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
}
