<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{EstadoCivil, Cargo, Funcionario, Documento, Telefone};
use Modules\Funcionario\Http\Requests\{CreateCargo};
use DB;

class FuncionarioController extends Controller{
    
    public function index(){
        $data = [
            'title' => 'Lista de Funcionários',
            'funcionarios' => Funcionario::paginate(10)
        ];

        return view('funcionario::funcionario.index', compact('data'));
    }

    public function list(Request $request, $status) {
        $funcionarios = new Funcionario;

        if($request['pesquisa']) {
            $funcionarios = $funcionarios->where('nome', 'like', '%'.$request['pesquisa'].'%');
        }

        if($status == 'inativos'){
            $funcionarios = $funcionarios->onlyTrashed();
        }

        $funcionarios = $funcionarios->paginate(10);

        return view('funcionario::funcionario.table', compact('funcionarios', 'status'));
    }
    
    public function create(){
        $data = [
            'url' => url("funcionario/funcionario"),
            'model' => '',
            'estado_civil' => EstadoCivil::all(),
            'estados' => [],
            'cidades' => [],
            'cargos' => Cargo::all(),
            'title' => 'Cadastro de Funcionário',
            'button' => 'Salvar'
        ];

        return view('funcionario::funcionario.form', compact('data'));
    }

    public function store(CreateCargo $request){

        // $validator = $request->validate([
        //     'cpf' => 'unique:documentos,tipo,'.$id.',id,tipo'
        // ]);

		DB::beginTransaction();
		try{

            $funcionario = Funcionario::create($request->input('funcionario'));
            
            foreach($request->documentos as $documento) {

                $nome = uniqid(date('HisYmd'));
                $extensao = $documento['comprovante']->extension();
                $nomeArquivo = "{$nome}.{$extensao}";
                $upload = $documento['comprovante']->storeAs('funcionario/documentos', $nomeArquivo);

                if (!$upload) {
                    return redirect()->back()->with('warning', 'Falha ao fazer upload de comprovante de documento')->withInput();
                }

                $documento['comprovante'] = $nomeArquivo;
                
                $funcionario->documentos()->save(new Documento($documento));

            }

            $funcionario->endereco()->create($request->input('endereco'));
            $contato = $funcionario->contato()->create($request->input('contato'));

            foreach($request->telefone as $telefone) {
                $contato->telefones()->save(new Telefone($telefone));
            }

			DB::commit();
            return redirect('/funcionario/funcionario')->with('success', 'Funcionário cadastrado com successo');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }
   
    public function show($id){
       
    }

    public function edit($id){
        $data = [
            "url" 	 	=> url("funcionario/funcionario/$id"),
            'estado_civil' => EstadoCivil::all(),
            'estados' => [],
            'cidades' => [],
            'cargos' => Cargo::all(),
			"button" 	=> "Atualizar",
			"model"		=> Funcionario::findOrFail($id),
			'title'		=> "Atualizar Funcionário"
		];

	    return view('funcionario::funcionario.form', compact('data'));
    }

    public function update(Request $request, $id){

        return $request;

        DB::beginTransaction();
		try{

            $funcionario = Funcionario::findOrFail($id);
            $funcionario->update($request->input('funcionario'));
            $funcionario->endereco()->update($request->input('endereco'));
            $contato = $funcionario->contato()->update($request->input('contato'));

            foreach($request->input('telefones') as $telefone){
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

        if($funcionario->trashed()) {
            $funcionario->restore();
            return back()->with('success', 'Usuário ativado com sucesso!');
        } else {
            $funcionario->delete();
            return back()->with('success', 'Usuário desativado com sucesso!');
        }
    }

    public static function brToEnDate($date) {
        return implode('-', array_reverse(explode('/', $date))) ? : '';
    }
}
