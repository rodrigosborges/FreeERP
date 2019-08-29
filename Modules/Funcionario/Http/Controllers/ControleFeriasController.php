<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Funcionario,Cargo,Ferias};
use DB;

class ControleFeriasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [
            'title' => 'Ferias',
            'funcionarios' => Funcionario::paginate(10)
        ];
        return view('funcionario::ferias.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $data = [
            'title' => 'Ferias',
        ];
        return view('funcionario::ferias.formulario', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
		try{
			$ferias = Ferias::Create($request->all());
			DB::commit();
			return redirect('funcionario/cargo')->with('success', 'Cargo cadastrado com sucesso!');
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    
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

    public function controleFerias($id)
    {
        $funcionario = Funcionario::findOrFail($id);
        $cargoAtual = $funcionario->cargos->last()->id;
        $funcionario_cargo =  $funcionario->cargos()->first();
        $admissao = date('d-m-Y', strtotime($funcionario_cargo->pivot->data_entrada));
        $data = [
            'title' => 'Ferias',
            'funcionario' => $funcionario,
            'cargo'            => Cargo::where('id','=',$cargoAtual)->first(),
            'admissao'=> $admissao
        ];
        return view('funcionario::ferias.formulario', compact('data'));
    }
}
