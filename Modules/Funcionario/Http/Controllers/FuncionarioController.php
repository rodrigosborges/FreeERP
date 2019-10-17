<?php

namespace Modules\Funcionario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Funcionario\Entities\{Cargo, Dependente, Parentesco,Atestado, Curso, AvisoPrevio, TipoDemissao, AvisoPrevioIndicadorCumprimento, Demissao, AvisoPrevioIndenizado};
use App\Entities\{EstadoCivil, Documento, Telefone, TipoDocumento, Cidade, Estado, TipoTelefone, Endereco, Email};
use Modules\Funcionario\Http\Requests\{CreateFuncionario, CreateDemissao};
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;



use DB;
use Modules\Funcionario\Entities\Funcionario;
use DateTime;


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

        if($request->hasFile('foto') && $request->file('foto')->isValid() && ($request->foto->extension() == 'jpg' || $request->foto->extension() == 'png' || $request->foto->extension() == 'jpeg')){
            $nome = md5(date('Y-m-d H:i'));
            $extensao = $request->foto->extension();
            $nameFile = "{$nome}.{$extensao}";
            $foto = $nameFile;
            $upload = $request->foto->storeAs('fotos', $nameFile);
            if(!$upload){
                return redirect()->back()->with('error', 'Falha no upload do arquivo');
            }
        }
        else{
            return redirect()->back()->with('error', 'Falha, formato de arquivo inválido');
        }

        DB::beginTransaction();
		try{

           
            $email = Email::create(['email' => $request->input('email')]);
            $endereco = Endereco::create($request->input('endereco'));
            $data_admissao = DateTime::createFromFormat('d/m/Y', $request->funcionario['data_admissao']);

            $funcionario = Funcionario::create([
                'nome' =>$request->funcionario['nome'],
                'data_nascimento' =>date('Y-m-d', strtotime($request->funcionario['data_nascimento'])),
                'sexo' =>$request->funcionario['sexo'],
                'data_admissao' => $data_admissao->format('Y-m-d'),
                'situacao'      => 'Ativo',    
                'estado_civil_id' =>$request->funcionario['estado_civil_id'],
                'email_id' => $email->id,
                'endereco_id' => $endereco->id, 
                'cargo_id' => $request->cargo['cargo_id'],
                'foto' => $foto,
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
        if(count($funcionario->documento()->get()) > 6){
            $documentos = $funcionario->documento()->get();
        }else{
            $documentos = null;
        }
        
        $variavel = Curso::where('funcionario_id','=',$id)->get();
        if(count($variavel) > 0){
            $cursos = $variavel;
        }else{
            $cursos = null;
        }
        // $cursos = Curso::where('funcionario_id','=',$id)->get();

        if(!$funcionario->dependente->first() == null){
            $dependente = $funcionario->dependente()->get();
        }

        $data = [
            "url" 	 	        => url("funcionario/funcionario/$id"),
            "model"		        => $funcionario,
            'tipo_documentos'   => TipoDocumento::whereNotIn("id",[1,2])->get(),
            'documentos'        => isset($documentos) ? $documentos : [new Documento],
            'dependentes'       => isset($dependente) ? $funcionario->dependente()->get() : [new Dependente],
            'parentescos'       => Parentesco::all(),
            'tipos_telefone'    => TipoTelefone::all(),
            'estado_civil'      => EstadoCivil::all(),
            'telefones'         => $funcionario->telefone()->get(),
            'estados'           => Estado::all(),
            'cidades'           => Cidade::all(),
            'cargos'            => Cargo::all(),
            'title'		        => "Atualizar Funcionário",
            "button" 	        => "Atualizar",
            'cursos'            =>  isset($cursos) ? $cursos : [new Curso]
        ];

	    return view('funcionario::funcionario.form', compact('data'));
    }

    public function update(CreateFuncionario $request, $id){
        
        DB::beginTransaction();
		try{

            $funcionario = Funcionario::findOrFail($id);
            $email = Email::create(['email' => $request->input('email')]);
            $endereco = Endereco::create($request->input('endereco'));
            $data_admissao = DateTime::createFromFormat('d/m/Y', $request->funcionario['data_admissao']);

            $funcionario->update([
                'nome' =>$request->funcionario['nome'],
                'data_nascimento' => date('Y-m-d', strtotime($request->funcionario['data_nascimento'])),
                'sexo' =>$request->funcionario['sexo'],
                'data_admissao' => $data_admissao->format('Y-m-d'),
                'estado_civil_id' =>$request->funcionario['estado_civil_id'],
                'email_id' => $email->id,
                'endereco_id' => $endereco->id, 
                
            ]);
            
            //Documentos
            foreach($request->documentos as $key => $documento) {
                if($documento['tipo_documento_id'] == 1)
                    $documento['numero'] = str_replace([".","-"],"",$documento['numero']);

                Documento::find($documento['id'])->update($documento);
            }

            //Endereço
            $funcionario->endereco()->update($request->input('endereco'));

            //Email
            $email = Email::where('id','=',$funcionario->email_id)->first();
            $email->update([
                'email' => $request->email,
                ]);

            //Telefones
            $funcionario->telefone()->detach();
            foreach($request->telefones as $key => $telefone){
                $tel = Telefone::Create($telefone);
                $funcionario->telefone()->attach($tel);
            }

            //Cursos
            if(!isset($request->cursos) || $request->cursos[0]['nome'] == null && $request->cursos[0]['area_atuacao'] == null && $request->cursos[0]['duracao_horas_curso'] == null && $request->cursos[0]['data_realizacao'] == null &&  $request->cursos[0]['validade_curso'] == null ){
                if(count($funcionario->curso()->get()) > 0){
                    $func_cursos = Curso::where("funcionario_id" , "=", $funcionario->id)->get();
                    foreach($func_cursos as $fcurso){
                        $fcurso->delete();
                    }
                }
            }else{
                foreach($request->cursos as $key => $curso){
                    if(isset($curso['id']) && $curso['id'] != null){
                        $cur = Curso::findOrFail($curso['id']);
                        $cur->update($curso);
                    }else{
                        $curso = [
                            'nome' => $curso['nome'],
                            'area_atuacao' => $curso['area_atuacao'],
                            'duracao_horas_curso' => $curso['duracao_horas_curso'],
                            'data_realizacao' =>  date('Y-m-d', strtotime($curso['data_realizacao'])),
                            'validade_curso' => $curso['validade_curso'],
                            'funcionario_id' => $funcionario->id
                        ];
                        $newCurso = Curso::create($curso);    
                    }
                }
            }

            //Docs Outros
            if(isset($request->docs_outros) && $request->docs_outros[0]['tipo_documento_id'] != null && $request->docs_outros[0]['numero'] != null){
                if(count($funcionario->documento()->get()) > 6 ){                    
                    foreach($request->docs_outros as $key => $docs){
                        if(isset($docs['id']) && $docs['id'] != null){
                            $doc = Documento::findOrFail($docs['id']);
                            $doc->update($docs);
                        }else{
                            $docs = [
                                'numero' => $docs['numero'],
                                'tipo_documento_id' => $docs['tipo_documento_id'],
                            ];
                            $newDoc = Documento::create($docs);    
                            $funcionario->documento()->attach($newDoc);
                        }
                    }
                }else{
                    foreach($request->docs_outros as $key => $docs){
                        $docs = [
                            'numero' => $docs['numero'],
                            'tipo_documento_id' => $docs['tipo_documento_id'],
                        ];
                        $newDoc = Documento::create($docs);    
                        $funcionario->documento()->attach($newDoc);
                    }
                }
            }else{
                
                if(count($funcionario->documento()->get()) > 6 ){
                    foreach($request->docs_outros as $key => $docs){
                        if($key > 6){
                            $doc = Documento::findOrFail($docs['id']);
                            $funcionario->document()->detach($doc);
                        }
                    }
                }


            }

            //Dependentes
            if($request->dependentes[0]['parentesco_id'] != "" && $request->dependentes[0]['mora_junto'] != "" && $request->dependentes[0]['nome'] != "" && $request->dependentes[0]['cpf'] != "" && $request->dependentes[0]['certidao_matricula'] != "" && $request->dependentes[0]['certidao_vacina'] != "") {
                foreach($request->dependentes as $dependente) {

                    if(isset($dependente['id']) && $dependente['id'] != null){
                        $dep = Dependente::findOrFail($dependente['id']);
                        $dep->update($dependente);
                    }else{
                        $dependente['funcionario_id'] = $funcionario['id'];
                        $newDep = Dependente::create($dependente);
                    }
                }
            }else{
                //return $funcionario->dependente()->get();
                if(count($funcionario->dependente()->get()) > 0){
                    $dependentes = Dependente::where('funcionario_id' , '=' , $funcionario->id)->get();
                    foreach ($dependentes as $key => $dep) {
                        $dep->delete();
                    }
                }
            }



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

        $data = [
            'funcionario' => Funcionario::findOrFail($id),
            
            'docs' => DB::table('funcionario')->join('funcionario_has_documento', 'funcionario_has_documento.funcionario_id', 'funcionario.id')
                ->join('documento', 'documento.id', '=', 'funcionario_has_documento.documento_id')
                ->join('tipo_documento', 'tipo_documento.id', '=', 'documento.tipo_documento_id')
                ->select('tipo_documento.nome', 'documento.numero')->get(),
            
            'cidade' => DB::table('funcionario')->join('endereco', 'funcionario.endereco_id', 'endereco.id')
                ->join('cidade', 'endereco.cidade_id', 'cidade.id')->get('cidade.nome')->last(),
            
            'estado' => DB::table('funcionario')->join('endereco', 'funcionario.endereco_id', 'endereco.id')
            ->join('cidade', 'endereco.cidade_id', 'cidade.id')
            ->join('estado', 'cidade.estado_id','estado.id')->get('estado.nome')->last(),

            'dependentes' => DB::table('dependente')->join('parentesco', 'dependente.parentesco_id', 'parentesco.id')->get()

            /*'dependentes_nome' => DB::table('dependente')->where('dependente.funcionario_id', $id)->get('nome')        */
        ];
    
     /* $parentesco = DB::table('funcionario')->join('dependente', 'dependente.funcionario_id', 'funcionario.id')->get();

        return $parentesco;*/
        //return $funcionario->dependente()->first()->parentesco()->nome;
        
        return view('funcionario::funcionario.ficha', compact('data'));
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
    public function search($valor) {

		$cargos = DB::table('cargo')->select('id', 'nome')->where('nome', 'like', '%'.$valor.'%')->where('cargo.deleted_at', null)->limit(10)->get();

		return $cargos;

    }
    
    public function demissao($id){
        $data = [
            'funcionario'       => Funcionario::findOrFail($id),
            'tipo_demissao'     => DB::table('tipo_demissao')->get(),
            'tipo_cumprimento'  => DB::table('aviso_previo_indicador_cumprimento')->get()
        ];
        
        return view('funcionario::funcionario.demissao', compact('data'));
    }

    public function storeDemissao(CreateDemissao $request){
        
        DB::beginTransaction();

        try {

            $demissao = Demissao::Create([
                'data_demissao'    => $request->data_demissao,
                'data_pagamento'   => $request->data_pagamento,
                'funcionario_id'   => $request['funcionario_id'],
                'tipo_demissao_id' => $request['tipo_demissao']
            ]);
            
            if($request->aviso_previo_indenizado == "on"){
                $avisoPrevioIndenizado = true;
                $descontarAvisoPrevio = false;

            } else {
                $avisoPrevioIndenizado = false;
                $descontarAvisoPrevio = true;
            }
            
            
            $avisoPrevio = AvisoPrevio::create([
                'aviso_previo_indenizado' => $avisoPrevioIndenizado,
                'descontar_aviso_previo'  => $descontarAvisoPrevio,
                'funcionario_id'          => $request['funcionario_id']  
            ]);

            if($avisoPrevioIndenizado){
               $avisoPrevioIndenizadoTabela = AvisoPrevioIndenizado::create([
                    'data_inicio_aviso'                     => $request->data_inicio_aviso,
                    'dias_aviso_indenizado'                 => $request->dias_aviso_indenizado,
                    'tipo_reducao_aviso'                    => $request->tipo_reducao_aviso,
                    'aviso_previo_id'                       => $avisoPrevio->id,
                    'aviso_previo_indicador_cumprimento_id' => $request->aviso_previo_indicador_cumprimento_id
               ]);
            }
            $id = $request['funcionario_id'];

            $funcionario = Funcionario::findOrFail($id);
            $funcionario->update(['situacao' => 'Demitido']);
            
            DB::commit();
           // return redirect()->action('FuncionarioController@showDemissao', ['id' => $id]);
            return redirect('/funcionario/funcionario')->with('success','Demissão cadastrada com sucesso');
        } catch(Exception $e){
            DB::rollback();
            return $e;
        }
    }

        public function showDemissao($id){
            $demissao = Demissao::where('funcionario_id', '=', $id)->get()->last()->data_demissao;
            $demissao = DateTime::createFromFormat('Y-m-d', $demissao)->format('d/m/Y');
            
           
            setlocale(LC_TIME, 'ptb'); // LC_TIME é formatação de data e hora com strftime()
            $now = Carbon::now();
            
            $data = [
                'nome'       => Funcionario::where('id', '=', $id)->get()->last()->nome,
                'demissao'   => $demissao,
                'dia_atual'  => $now->formatLocalized('Caraguatatuba, %d de %B de %Y'),
                'id'         => $id   
            ];
           
            return view('funcionario::funcionario.showDemissao', compact('data'));
        }

        public function destroyDemissao($id){
            DB::beginTransaction();
            try {
                $demissaoId = Demissao::where('funcionario_id', '=', $id)->get()->last()->id;
                $avisoPrevioId = AvisoPrevio::where('funcionario_id', '=', $id)->get()->last()->id;
                
                $demissao = Demissao::findOrFail($demissaoId);
                $avisoPrevio = AvisoPrevio::findOrFail($avisoPrevioId);
               
                $avisoPrevioIndenizadoRegistro = AvisoPrevio::where('funcionario_id', '=', $id)->get()->last()->aviso_previo_indenizado;
                
                if($avisoPrevioIndenizadoRegistro == 1){
                   
                    $avisoPrevioId = AvisoPrevio::where('funcionario_id', '=', $id)->get()->last()->id;
                    $avisoPrevioIndenizadoId = AvisoPrevioIndenizado::where('aviso_previo_id', '=', $avisoPrevioId)->get()->last()->id;
                  
                    $avisoPrevioIndenizado = AvisoPrevioIndenizado::FindOrFail($avisoPrevioIndenizadoId);
                    $avisoPrevioIndenizado->delete();
                }

                $demissao->delete();
                $avisoPrevio->delete();

                $funcionario = Funcionario::findOrFail($id);
                $funcionario->update(['situacao' => 'Ativo']);
                
                DB::commit();
                return redirect('/funcionario/funcionario')->with('success','Demissão cancelada com sucesso.');

            } catch(Exception $e){
                DB::rollback();
                return $e;
            }
        }
        //parte de atestado
        public function CreateAtestado($id){
            
            $data = [   
                'atestado'      => '',
                'title'         => 'Cadastro de Atestado',
                'funcionario'   => Funcionario::findOrFail($id),
                'url'           => 'funcionario/funcionario/storeAtestado',
                'method'        => 'post'
                
            ];
           
            return view('funcionario::funcionario.atestado',compact('data'));
        }

    public function storeAtestado(Request $request){
        DB::beginTransaction();
        try{
        $atestado = Atestado::create([
            'cid_atestado' => $request['atestado']['cid_atestado'],
            'data_inicio' => $request['atestado']['data_inicio'],
            'quantidade_dias' => $request['atestado']['quantidade_dias'],
            'data_fim' => $request['atestado']['data_fim'],
            
            'funcionario_id' => $request['atestado']['funcionario_id']
            
        ]);
        DB::commit();
        return redirect('/funcionario/funcionario')->with('success','Atestado cadastrado com sucesso');
    }catch(Exception $e){
        DB::rollback();
        return back()->with('error', 'Error >:(');
        
    }
            
        
    }


}
