<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Pagamento,Funcionario};


class PagamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request){
            
        $data = [
            
			'funcionarios'=> Funcionario::paginate(10),
			'title'	     => "Pagamentos",
		];

	    return view('funcionario::pagamentos.index', compact('data'));
	}

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create(Request $request){
        $data = [

            "url" 	 	=> url('funcionario/pagamentos'),
            "button" 	=> "Salvar",
            "model"		=> null,
            'title'		=> "Cadastrar Pagamento"
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
        //
        return 1;
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
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
