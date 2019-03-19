<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Aula;
use App\Professor;
use App\Aluno;
use DB;

class AulaController extends Controller{

    public function index(Request $request){
        $data = [
			'aulas'	=> Aula::all(),
			'title'		=> "Lista de aulas",
		]; 
			
		//responde uma view e adiciona a variável data à ela
	    return view('aula.index', compact('data'));
    }
    
	public function create(Request $request){
		$data = [
			"url" 	 		=> url('aula'),
			"button" 		=> "Salvar",
			"model"			=> null,
			'title'			=> "Cadastrar aula",
			'professores'	=> Professor::all(),
			'alunos'		=> Aluno::withTrashed()->get(),
			'aulas_alunos'	=> [''],
		];
	    return view('aula.form', compact('data'));
	}

	public function store(Request $request){
		//mesmo esquema do sql, espera o commit para enviar para o database
		DB::beginTransaction();
		try{
			//Cria o aula com os dados inputs
			$aula = Aula::Create($request->all());

			//relaciona todos os ids ao relacionamento de aulas-alunos (alunos_has_aulas)
			$aula->alunos()->sync($request->alunos);

			//envia para o banco de dados
			DB::commit();

			//redireciona para uma url solicitada
			return redirect('/aula');
		}catch(Exception $e){

			//Não executa o sql, caso tenha dado erro
			DB::rollback();

			//Retorna pra ultima url
			return back();
		}
    }
    
	public function edit(Request $request, $id){
		$data = [
			"url" 	 		=> url("aula/$id"),
			"button" 		=> "Atualizar",
			"model"			=> Aula::findOrFail($id),
			'title'			=> "Atualizar aula",
			'professores'	=> Professor::all(),
			'alunos'		=> Aluno::withTrashed()->get(),
			'aulas_alunos'	=> Aula::findOrFail($id)->alunos()->allRelatedIds(),
		];
	    return view('aula.form', compact('data'));
	}
	
	public function update(Request $request, $id) {
		DB::beginTransaction();
		try{
			$aula = Aula::findOrFail($id);
			$aula->update($request->all());
			$aula->alunos()->sync($request->alunos);
			DB::commit();
			return redirect('/aula');
		}catch(Exception $e){
			DB::rollback();
			return back();
		}
    }
    
	public function show(Request $request, $id){
		$aula = Aula::findOrFail($id);
	    return view('aula.show', [
            'model' => $aula	    
        ]);
    }
    
	public function destroy(Request $request, $id) {
		$aula = Aula::findOrFail($id);
		$aula->alunos()->detach();
		$aula->delete();
		return back();    
	}
	
}