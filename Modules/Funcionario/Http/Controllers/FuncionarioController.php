<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{EstadoCivil, Cargo, Funcionario};
use DB;

class FuncionarioController extends Controller{
    
    public function index(){
        
    }
    
    public function create(){
        $data = [
            'url' => url("funcionario"),
            'model' => '',
            'estado_civil' => EstadoCivil::all(),
            'estados' => [],
            'cidades' => [],
            'cargos' => Cargo::all(),
            'title' => 'Cadastro de Funcionário'
        ];

        return view('funcionario::funcionario.form', compact('data'));
    }

    public function store(Request $request){
		DB::beginTransaction();
		try{

			$funcionario = Funcionario::create($request->input('funcionario'));
            $funcionario->endereco()->create($request->input('endereco'));
            $contato = $funcionario->contato()->create($request->input('contato'));
            $contato->telefones()->create($request->input('telefone'));
			DB::commit();
            return redirect('/funcionario')->with('success', 'Funcionário cadastrado com successo');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }
   
    public function show($id){
       
    }

    public function edit($id){
        
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
		try{

            $funcionario = Funcionario::findOrFail($id);
            $funcionario->update($request->input('funcionario'));
            $funcionario->endereco()->update($request->input('endereco'));
            $contato = $funcionario->contato()->update($request->input('contato'));

            foreach($request->input('telefone') as $telefone){
                if($telefone['id'])
                    Telefone::find($telefone['id'])->update($telefone);
                else
                    $contato->telefones()->save($telefone);
            }

			DB::commit();
            return redirect('/funcionario')->with('success', 'Funcionário atualizado com successo');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }
    
    public function destroy($id){
        $funcionario = Funcionario::withTrashed()->findOrFail($id);

        if($funcionario->trashed())
            $funcionario->restore();
        else
            $funcionario->delete();
    }
}
