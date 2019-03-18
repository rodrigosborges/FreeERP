<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Aluno;
use App\Endereco;
use DB;

class AlunoController extends Controller{

    public function index(Request $request){
        $data = [
			'alunos'			=> Aluno::all(),
			'alunos_deletados'	=> Aluno::onlyTrashed()->get(),
			'title'				=> "Lista de alunos",
		]; 
			
		//responde uma view e adiciona a variável data à ela
	    return view('aluno.index', compact('data'));
    }
    
	public function create(Request $request){
		$data = [
			"url" 	 	=> url('aluno'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar aluno"
		];
	    return view('aluno.form', compact('data'));
	}

	public function store(Requests\AlunoCreate $request){
		//mesmo esquema do sql, espera o commit para enviar para o database
		DB::beginTransaction();
		try{
			//Cria o aluno com os dados inputs
			$aluno = Aluno::Create($request->all());

			//chama o relacionamento de endereço do aluno,  e cria um endereço relacionado à ele
			$aluno->endereco()->create($request->all());

			//envia para o banco de dados
			DB::commit();

			//redireciona para uma url solicitada
			return redirect('/aluno')->with('success', 'Aluno cadastrado com successo');
		}catch(Exception $e){

			//Não executa o sql, caso tenha dado erro
			DB::rollback();

			//Retorna pra ultima url
			return back()->with('error', 'Erro no servidor');
		}
    }
    
	public function edit(Request $request, $id){
		$data = [
			"url" 	 	=> url("aluno/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Aluno::findOrFail($id),
			'title'		=> "Atualizar aluno"
		];
	    return view('aluno.form', compact('data'));
	}
	
	public function update(Request $request, $id) {
		DB::beginTransaction();
		try{
			$aluno = Aluno::findOrFail($id);
			$aluno->update($request->all());
			$aluno->endereco->update($request->all());
			DB::commit();
			return redirect('/aluno')->with('success', 'Aluno atualizado com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }
    
	public function show(Request $request, $id){
		$aluno = Aluno::findOrFail($id);
	    return view('aluno.show', [
            'model' => $aluno	    
        ]);
	}
    
	public function destroy(Request $request, $id) {
		$aluno = Aluno::withTrashed()->findOrFail($id);
		if($aluno->trashed())
			$aluno->restore();
		else
			$aluno->delete();
		return back()->with('success', $aluno->deleted_at ? 'Aluno deletado' : 'Aluno restaurado');    
	}
	
}