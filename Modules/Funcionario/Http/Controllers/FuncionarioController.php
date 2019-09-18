<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Cargo, Dependente, Parentesco, Curso};
use App\Entities\{EstadoCivil, Documento, Telefone, TipoDocumento, Cidade, Estado, TipoTelefone, Endereco, Email};
use Modules\Funcionario\Http\Requests\CreateFuncionario;
use Illuminate\Support\Facades\Storage;
use DB;
use Modules\Funcionario\Entities\Funcionario;


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
            'url'               => url("funcionario/funcionario"),
            'model'             => '',
            'tipo_documentos'   => TipoDocumento::whereNotIn("id",[1,2,4,7,8,9])->get(),
            'documentos'        => [new Documento],
            'telefones'         => [new Telefone],
            'dependentes'       => [new Dependente],
            'cursos'            => [new Curso],
            'parentescos'       => Parentesco::all(),
            'tipos_telefone'    => TipoTelefone::all(),
            'estado_civil'      => EstadoCivil::all(),
            'estados'           => Estado::all(),
            'cargos'            => Cargo::all(),
            'title'             => 'Cadastro de Funcionário',
            'button'            => 'Salvar',
        ];

        return view('funcionario::funcionario.form', compact('data'));
    }

    public function store(CreateFuncionario $request){

        DB::beginTransaction();
		try{

           
            $email = Email::create(['email' => $request->input('email')]);
            $endereco = Endereco::create($request->input('endereco'));

            $funcionario = Funcionario::create([
                'nome' =>$request->funcionario['nome'],
                'data_nascimento' =>date('Y-m-d', strtotime($request->funcionario['data_nascimento'])),
                'sexo' =>$request->funcionario['sexo'],
                'data_admissao' =>date('Y-m-d', strtotime($request->funcionario['data_admissao'])),
                'estado_civil_id' =>$request->funcionario['estado_civil_id'],
                'email_id' => $email->id,
                'endereco_id' => $endereco->id, 
                'cargo_id' => $request->cargo['cargo_id']
                
            ]);

      
            $funcionario->cargos()->attach(
                
                $request['cargo']['cargo_id'],
                ['data_entrada' => brToEnDate($request['funcionario']['data_admissao'])]
            );

           
            foreach($request->documentos as $documento) {

                

                if($documento['tipo_documento_id'] == 1)
                    $documento['numero'] = str_replace([".","-"],"",$documento['numero']);

                $newDoc = [
                    'tipo_documento_id'     => $documento['tipo_documento_id'],
                    'numero'                => $documento['numero']
                ];
                     
                $doc = Documento::create($newDoc);
                //dd($doc);
                //Ajustar Attach de Documentos
                // $funcionario->documento()->attach([
                //     'documento_id'=>$doc->id,
                //     'funcionario_id'$funcionario->id,
                // ]
                // );
                

                $funcionario->documento()->attach([
                    'documento_id'=> $doc->id
                  ]
                );
            }

            if($request->docs_outros[0]['numero'] != "" && $request->docs_outros[0]['tipo_documento_id'] != "" ) {
                foreach($request->docs_outros as $documento) {
                    if($documento['numero']){

                        if($documento['tipo_documento_id'] == 1)
                            $documento['numero'] = str_replace([".","-"],"",$documento['numero']);

                        if(isset($documento['comprovante'])) {

                            $nome = uniqid(date('HisYmd'));
                            $extensao = $documento['comprovante']->extension();
                            $nomeArquivo = "{$nome}.{$extensao}";
                            $upload = $documento['comprovante']->storeAs('funcionario/documentos', $nomeArquivo);

                            if (!$upload) {
                                return redirect()->back()->with('warning', 'Falha ao fazer upload de comprovante de documento')->withInput();
                            }

                            $documento['comprovante'] = $nomeArquivo;
                        
                        }
                        
                        $doc = Documento::create($documento);
                        
                    }
                }
            }



            foreach($request->telefones as $telefone) {
           
                $telefone = Telefone::create($telefone);

                $funcionario->telefone()->attach([
                    'telefone_id'=> $telefone->id
                  ]
                );
            }

            if($request->dependentes[0]['parentesco_id'] != "" && $request->dependentes[0]['mora_junto'] != "" && $request->dependentes[0]['nome'] != "" && $request->dependentes[0]['cpf'] != "" && $request->dependentes[0]['certidao_matricula'] != "" && $request->dependentes[0]['certidao_vacina'] != "") {
                foreach($request->dependentes as $dependente) {
                    
                    $dependente['funcionario_id'] = $funcionario['id'];

                    $newDep = Dependente::create($dependente);
                    
                    $doc = [
                        'tipo_documento_id'   => '1',
                        'numero'              => $dependente['cpf']
                    ];
                    
                    $cpf = Documento::create($doc);
                    

                }
            }

            if($request->cursos[0]['nome'] != "" && $request->cursos[0]['area_atuacao'] != "" && $request->cursos[0]['duracao_horas_curso'] != "" && 
               $request->cursos[0]['data_realizacao'] != "" && $request->cursos[0]['validade_curso'] != ""){
                
                foreach($request->cursos as $key => $curso){
                    $curso = [
                        'nome' => $curso['nome'],
                        'area_atuacao' => $curso['area_atuacao'],
                        'duracao_horas_curso' => $curso['duracao_horas_curso'],
                        'data_realizacao' =>  date('Y-m-d', strtotime($curso['data_realizacao'])),
                        'validade_curso' => $curso['validade_curso'],
                        'funcionario_id' => $email->id
                    ];
                  
                    $newCurso = Curso::create($curso);    
                }
               }


			DB::commit();
            return redirect('/funcionario/funcionario')->with('success', 'Funcionário cadastrado com successo!');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }
   
    public function show($id){
       
    }

    public function edit($id){

        $funcionario = Funcionario::findOrFail($id);

        $documentos = Documento::whereNotIn('tipo_documento_id', [1,2])->join('relacao','documento.id','=','relacao.destino_id')->where('relacao.origem_id',$id)->where('relacao.tabela_origem','funcionario')->where('relacao.tabela_destino','documento')->select('documento.*')->get();
        
        $data = [
            "url" 	 	        => url("funcionario/funcionario/$id"),
            "model"		        => $funcionario,
            'tipo_documentos'   => TipoDocumento::whereNotIn("id",[1,2])->get(),
            'documentos'        => count($documentos) ? $documentos : [new Documento],
            'dependentes'       => count($funcionario->dependentes) ? $funcionario->dependentes : [new Dependente],
            'parentescos'       => Parentesco::all(),
            'tipos_telefone'    => TipoTelefone::all(),
            'estado_civil'      => EstadoCivil::all(),
            'telefones'         => $funcionario->telefones(),
            'estados'           => Estado::all(),
            'cargos'            => Cargo::all(),
            'title'		        => "Atualizar Funcionário",
			"button" 	        => "Atualizar",
        ];

	    return view('funcionario::funcionario.form', compact('data'));
    }

    public function update(CreateFuncionario $request, $id){

        DB::beginTransaction();
		try{

            $funcionario = Funcionario::findOrFail($id);

            $funcionario->update($request->input('funcionario'));

            $funcionario->estadoCivilRelacao()->update(['destino_id' => $request->funcionario['estado_civil_id']]);

            foreach($request->documentos as $key => $documento) {
                if($documento['tipo_documento_id'] == 1)
                    $documento['numero'] = str_replace([".","-"],"",$documento['numero']);

                Documento::find($documento['id'])->update($documento);
            }

            $funcionario->endereco()->update($request->input('endereco'));

            //remoção de documentos

            $documentosRequestIds = [];

            if($request->input('docs_outros')) {
                foreach($request->input('docs_outros') as $documento) {
                    if(isset($documento['id'])) {
                        $documentosRequestIds[] = $documento['id'];
                    }
                }          
            }

            $documentosFuncionarioIds = [];

            foreach($funcionario->documentos() as $documento) {
                if($documento->tipo_documento_id != 1 && $documento->tipo_documento_id != 2){
                    $documentosFuncionarioIds[] = $documento->id;
                }
            }

            $documentosExcluir = [];
            
            $documentosRemovidos = array_diff($documentosFuncionarioIds, $documentosRequestIds);

            if(count($documentosRemovidos) > 0) {
                foreach($documentosRemovidos as $documentoId) {
                    $documento = Documento::find($documentoId);
                    $documentosExcluir[] = "funcionario/documentos/".$documento->comprovante; 
                    $documento->delete();
                    Relacao::where('tabela_origem','funcionario')->where('origem_id',$funcionario->id)->where('tabela_destino','documento')->where('destino_id',$documentoId)->delete();
                }
            }
            //####################

            if($request->input('docs_outros')) {

                foreach($request->docs_outros as $documento){
                    if($documento['numero']){
                        if(isset($documento['comprovante'])) {

                            $nome = uniqid(date('HisYmd'));
                            $extensao = $documento['comprovante']->extension();
                            $nomeArquivo = "{$nome}.{$extensao}";
                            $upload = $documento['comprovante']->storeAs('funcionario/documentos', $nomeArquivo);
            
                            if (!$upload) {
                                return redirect()->back()->with('warning', 'Falha ao fazer upload de comprovante de documento')->withInput();
                            }

                            $documento['comprovante'] = $nomeArquivo;
                        
                        }

                        if(isset($documento['id'])){

                            $documentoModel = Documento::find($documento['id']);

                            if(isset($documento['comprovante']) && $documentoModel->comprovante)
                                $documentosExcluir[] = "funcionario/documentos/".$documentoModel->comprovante;

                            $documentoModel->update($documento);

                        }else{
                            $documentoModel = Documento::create($documento);
                        }

                        if(!isset($documento['id'])){
                            Relacao::create([
                                'tabela_origem'     => 'funcionario',
                                'origem_id'         => $funcionario->id,
                                'tabela_destino'    => 'documento',
                                'destino_id'        => $documentoModel->id,
                                'modelo'            => 'Documento'
                            ]);
                        }
                    }
                }

            }

            //remoção de telefones
            foreach($request->input('telefones') as $telefone) {
                $telefonesRequestIds[] = $telefone['id'];
            }

            foreach($funcionario->telefones() as $telefone) {
                $telefonesFuncionarioIds[] = $telefone->id;
            }

            $telefonesRemovidos = array_diff($telefonesFuncionarioIds, $telefonesRequestIds);

            if(count($telefonesRemovidos) > 0) {
                foreach($telefonesRemovidos as $telefoneId) {
                    Telefone::find($telefoneId)->delete();
                    Relacao::where('tabela_origem','funcionario')->where('origem_id',$funcionario->id)->where('tabela_destino','telefone')->where('destino_id',$telefoneId)->delete();
                }
            }
            //####################

            foreach($request->input('telefones') as $telefone){
                if($telefone['id'] != null)
                    Telefone::find($telefone['id'])->update($telefone);
                else {
                    $telefone = Telefone::create($telefone);
                    
                    Relacao::create([
                        'tabela_origem'     => 'funcionario',
                        'origem_id'         => $funcionario->id,
                        'tabela_destino'    => 'telefone',
                        'destino_id'        => $telefone->id,
                        'modelo'            => 'Telefone'
                    ]);
                }
            }

            //remoção de dependentes

            $dependentesRequestIds = [];

            if($request->input('dependentes')) {
                foreach($request->input('dependentes') as $dependente) {
                    if(isset($dependente['id'])) {
                        $dependentesRequestIds[] = $dependente['id'];
                    }
                }          
            }

            $dependentesFuncionarioIds = [];

            foreach($funcionario->dependentes as $dependente) {
                $dependentesFuncionarioIds[] = $dependente->id;
            }
            
            $dependentesRemovidos = array_diff($dependentesFuncionarioIds, $dependentesRequestIds);

            if(count($dependentesRemovidos) > 0) {
                foreach($dependentesRemovidos as $dependenteId) {
                    $dependente = Dependente::find($dependenteId);
                    $dependente->delete();
                    Relacao::where('tabela_origem','dependente')->where('origem_id',$dependente->id)->where('tabela_destino','documento')->where('destino_id',$dependente->cpf()->id)->delete();
                }
            }
            //####################

            if($request->dependentes) {

                foreach($request->dependentes as $dependente){

                    if(isset($dependente['id'])){

                        $dep = Dependente::find($dependente['id']);
                        $dep->update([$dependente]);
                        
                        $cpf = str_replace([".","-"],"",$dependente['cpf']);
                        $dep->cpf()->update(['numero' => $cpf]);

                    }else{

                        $dependente['funcionario_id'] = $funcionario['id'];
                        $newDep = Dependente::create($dependente);

                        $doc = [
                            'tipo_documento_id'   => '1',
                            'numero'              => str_replace([".","-"],"",$dependente['cpf'])
                        ];
                        
                        $cpf = Documento::create($doc);
        
                        Relacao::create([
                            'tabela_origem'     => 'dependente',
                            'origem_id'         => $newDep->id,
                            'tabela_destino'    => 'documento',
                            'destino_id'        => $cpf->id,
                            'modelo'            => 'Telefone'
                        ]);

                    }

                }

            }

            #caso tudo dê certo acima, ele exclui os arquivos inutilizados
            Storage::delete($documentosExcluir);

			DB::commit();
            return redirect('/funcionario/funcionario')->with('success', 'Funcionário atualizado com successo!');
            
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

    public function ficha($id){
        $funcionario = Funcionario::findOrFail($id);
        return view('funcionario::funcionario.ficha', compact('funcionario'));
    }

    public function getCidades($uf) {

        $estado = Estado::where('uf', $uf)->first();

        return $estado ? $estado->cidades()->select('id','nome')->get() : [];
 
    }

    public function editCargo($id){
        $funcionario = Funcionario::findOrFail($id);
        $cargoAtual = $funcionario->cargos->last()->id;
        $data = [
            'url'               => url("funcionario/funcionario/editCargo/$id"),
            'model'             => $funcionario,
            'cargos'            => Cargo::where('id','<>',$cargoAtual)->get(),
            'title'             => 'Edição de cargos',
            'button'            => 'Salvar',
        ];

        return view('funcionario::funcionario.cargo', compact('data'));
    }

    public function updateCargo($id, Request $request){
        DB::beginTransaction();
		try{
            $funcionario = Funcionario::findOrFail($id);
            $data = implode('-', array_reverse(explode('/', $request['cargo']['data_entrada'])));
            $cargo = $funcionario->cargos->last();
            $cargo->pivot->data_saida = $data;
            $cargo->pivot->update();
            
            $funcionario->cargos()->attach(
                $request['cargo']['cargo_id'],
                ['data_entrada' => $data]
            );
            
			DB::commit();
            return redirect('/funcionario/funcionario')->with('success', 'Cargo do funcionário atualizado com successo!');
            
		}catch(Exception $e){

			DB::rollback();
            return back()->with('error', 'Erro no servidor');
            
		}
    }

    public function downloadComprovante($id){
        $documento = Documento::findOrFail($id);
        if($documento->comprovante){
            return Storage::download('funcionario/documentos/'.$documento->comprovante);
        }
    }

}
