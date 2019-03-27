<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Professor;
use App\Endereco;
use DB;

class ProfessorController extends Controller{

    public function index(Request $request){
        $data = [
			'professores'	=> Professor::all(),
			'title'		=> "Lista de professores",
		]; 
			
		//responde uma view e adiciona a variável data à ela
	    return view('professor.index', compact('data'));
    }
    
	public function create(Request $request){
		$data = [
			"url" 	 	=> url('professor'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar professor"
		];
	    return view('professor.form', compact('data'));
	}

	public function store(Request $request){
		DB::beginTransaction();
		try{
			$professor = Professor::Create($request->all());
			DB::commit();
			return redirect('/professor');
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    }
    
	public function edit(Request $request, $id){
		$data = [
			"url" 	 	=> url("professor/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Professor::findOrFail($id),
			'title'		=> "Atualizar professor"
		];
	    return view('professor.form', compact('data'));
	}
	
	public function update(Request $request, $id) {
		DB::beginTransaction();
		try{
			$professor = Professor::findOrFail($id);
			$professor->update($request->all());
			DB::commit();
			return redirect('/professor');
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    }
    
	public function show(Request $request, $id){
		$professor = Professor::findOrFail($id);
	    return view('professor.show', [
            'model' => $professor	    
        ]);
    }
    
	public function destroy(Request $request, $id) {
		$professor = Professor::findOrFail($id);
		$professor->delete();
		return back();    
	}
	
}