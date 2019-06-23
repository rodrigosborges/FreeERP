<?php
namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Cargo,Funcionario};
use Modules\Funcionario\Http\Requests\{CreateCargo};
use DB;

class CargoController extends Controller{

    public function index(Request $request){
        $data = [
			'cargos'	=> Cargo::all(),
			'title'		=> "Lista de cargos",
		];

	    return view('funcionario::cargo.index', compact('data'));
	}
	
	public function list(Request $request, $status){
		$cargos = new Cargo;

		if($request['pesquisa']) {
            $cargos = $cargos->where('nome', 'like', '%'.$request['pesquisa'].'%');
        }

		if($status == "inativos")
			$cargos = $cargos->onlyTrashed();

		$cargos = $cargos->paginate(10);
		return view('funcionario::cargo.table', compact('cargos','status'));
	}
    
	public function create(Request $request){
		$data = [
			"url" 	 	=> url('funcionario/cargo'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar cargo"
		];
		
	    return view('funcionario::cargo.form', compact('data'));
	}

	public function store(Request $request){
		DB::beginTransaction();
		try{
			$cargo = Cargo::Create($request->all());
			DB::commit();
			return redirect('funcionario/cargo')->with('success', 'Cargo cadastrado com sucesso!');
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    }
    
	public function edit(Request $request, $id){
		$data = [
			"url" 	 	=> url("funcionario/cargo/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Cargo::findOrFail($id),
			'title'		=> "Atualizar cargo"
		];

	    return view('funcionario::cargo.form', compact('data'));
	}
	
	public function update(CreateCargo $request,$id) {
		DB::beginTransaction();
		try{
			$cargo = Cargo::findOrFail($id);
			$cargo->update($request->all());
			DB::commit();
			return redirect('funcionario/cargo')->with('success', 'Cargo atualizado com sucesso!');
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    }
    
	public function show(Request $request, $id){
		$cargo = Cargo::findOrFail($id);
	    return view('funcionario::cargo.show', [
            'model' => $cargo	    
        ]);
    }
    
	public function destroy(Request $request, $id) {
		$cargo = Cargo::withTrashed()->find($id);
		if($cargo->trashed()){
			$cargo->restore();
			return back()->with('success', 'Cargo ativado com sucesso!');
		}
		else{
			$cargo->delete();
			return back()->with('success', 'Cargo desativado com sucesso!');
		}
	}

	public function search($valor) {

		$cargos = DB::table('cargo')->select('id', 'nome')->where('nome', 'like', '%'.$valor.'%')->where('cargo.deleted_at', null)->limit(10)->get();

		return $cargos;

	}
	
}