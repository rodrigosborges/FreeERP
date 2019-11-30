<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Entities\{Endereco,Estado,Cidade, Email, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,Etapa};
use Auth;


class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    protected $moduleInfo;
    protected $menu;
    public function  __construct(){
        $this->moduleInfo = [
            'icon' => 'people',
            'name' => 'RECRUTAMENTO',
        ];
        
            $this->menu = [
                ['icon' => 'next_week', 'tool' => 'Vagas', 'route' => '/recrutamento/vaga'],
                ['icon' => 'category', 'tool' => 'Categorias', 'route' => '/recrutamento/categoria'],
                ['icon' => 'work', 'tool' => 'Cargos', 'route' => '/recrutamento/cargo'],
                ['icon' => 'assignment', 'tool' => 'Etapas', 'route' => '/recrutamento/etapa'],
                ['icon' => 'group', 'tool' => 'Candidatos', 'route' => '/recrutamento/candidato'],
                ['icon' => 'email', 'tool' => 'Emails', 'route' => '/recrutamento/mensagem/malaDireta'],
                ['icon' => 'card_giftcard', 'tool' => 'Benefícios', 'route' => '/recrutamento/beneficio'],
                ['icon' => 'power_settings_new', 'tool' => 'Logout', 'route' => '/logout'],
            ];
       
    }
    
    public function index(Request $request)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        if($request->pesquisa != "" || $request->pesquisa != null){
            $candidatos = Candidato::where('nome', 'like', '%'.$request->pesquisa.'%')->get();
            $candidatosInativos = Candidato::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->get();
        }else{
            $candidatos = Candidato::all();
            $candidatosInativos = Candidato::onlyTrashed()->get();
        }

        $data = [
			'candidatos'		=> $candidatos,
			'candidatos_inativos'		=> $candidatosInativos,
			'title'		=> "Lista de Candidatos",
		]; 
        return view('recrutamento::candidato.index', compact('data','moduleInfo','menu'));
    }

    public function create(Request $request)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			"url" 	 	=> url("recrutamento/candidato/"),
			"button" 	=> "Salvar",
			"model"		=> null,
            'title'		=> "Cadastrar Candidato",
            'vaga'      =>  Vaga::where('status', 'disponivel')->get(),
            'cidades'   =>  Cidade::all(),
            'estados'   =>  Estado::all(),
            'telefone'         => [
                'tipo_telefone_id' => 0
            ],
            'tipos_telefone'    => TipoTelefone::all(),
    

		];
        return view('recrutamento::candidato.formulario_candidato',compact('data','moduleInfo','menu'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {        

        //Upload do Curriculum
  
        if($request->hasFile('curriculum') && $request->file('curriculum')->isValid() && ($request->curriculum->extension() == 'pdf' || $request->curriculum->extension() == '.pdf') ){
            $nome = md5($request->candidato['nome'].date('Y-m-d H:i'));
            $extensao = $request->curriculum->extension();
            $nameFile = "{$nome}.{$extensao}";
            $curriculum = $nameFile;

            $upload = $request->curriculum->storeAs('curriculos', $nameFile);
            if(!$upload){
                return back()->with('error', 'Falha no upload do curriculum');
            }
        }
        else{
            return back()->with('error', 'Falha, formato de curriculum inválido');
        }

        //Upload do Foto
        $allowedExts = array("jpeg", "jpg", "png");
        if($request->hasFile('foto') && $request->file('foto')->isValid() &&  in_array($request->foto->extension(), $allowedExts) ){
            $nome = md5($request->candidato['nome'].date('Y-m-d H:i'));
            $extensao = $request->foto->extension();
            $nameFile = "{$nome}.{$extensao}";
            $foto = $nameFile;

            $upload = $request->foto->storeAs('fotos', $nameFile);
            if(!$upload){
                return redirect()->back()->with('error', 'Falha no upload da foto');
            }
        }
        else{
            return redirect()->back()->with('error', 'Falha, formato da foto');
        }

        
        DB::beginTransaction();
		try{

            $telefone = Telefone::Create($request->telefone);
            $email = Email::Create($request->email);
            $endereco = Endereco::Create($request->endereco);
            $candidato = Candidato::Create([
                'nome' => $request->candidato['nome'],
                'vaga_id' => $request->candidato['vaga_id'],
                'curriculo' => $curriculum,
                'foto' => $foto,
                'endereco_id'=>$endereco->id,
                'email_id'=>$email->id,
                'telefone_id'=>$telefone->id
            ]);            
            
                
			DB::commit();
			return redirect('/recrutamento/vagasDisponiveis')->with('success', 'Curriculo enviado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {

        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			"url" 	 	=> url("recrutamento/candidato/"),
			"button" 	=> "Enviar Mensagem",
			"model"		=> null,
            "title"		=> "Candidato",
            "candidato" => Candidato::findOrFail($id),    
            "telefone" => Candidato::findOrFail($id)->telefone()->get(),    
            "email" => Candidato::findOrFail($id)->email()->get(),    
            "endereco" => Candidato::findOrFail($id)->endereco()->get(),  

		];
        return view('recrutamento::candidato.show',compact('data','moduleInfo','menu'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			"url" 	 	=> url("recrutamento/candidato/"),
			"button" 	=> "Atualizar",
			"model"		=> Candidato::findOrFail($id),
            'title'		=> "Atualizar Candidato",
            'vaga'      =>  Vaga::where('status', 'disponivel')->get()
		];
        return view('recrutamento::candidato.formulario_candidato',compact('data','moduleInfo','menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
		try{
			$candidato = Candidato::findOrFail($id);
			$candidato->update($request->all());
			DB::commit();
			return redirect('recrutamento/candidato')->with('success', 'Curriculo atualizado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $candidato = Candidato::findOrFail($id);
		$candidato->delete();
		return back()->with('success',  'Candidato deletado'); 
    }

    public function restore($id)
    {
        DB::beginTransaction();
		try{    
            $candidato = Candidato::onlyTrashed()->where('id', $id)->first();
            $candidato->restore();          
			DB::commit();
			return back()->with('success', 'Candidato restaurado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function novo($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu = [
            ['icon' => 'assignment', 'tool' => 'Vagas Disponíveis', 'route' => '/recrutamento/vagasDisponiveis'],
        ];
        $data = [
			"url" 	 	=> url("recrutamento/candidato/"),
			"button" 	=> "Salvar",
			"model"		=> null,
            'title'		=> "Cadastrar Candidato",
            'vaga'      =>  Vaga::findOrFail($id),
            'cidades'   =>  Cidade::all(),
            'estados'   =>  Estado::all(),
            'telefone'         => [
                'tipo_telefone_id' => 0
            ],
            'tipos_telefone'    => TipoTelefone::all(),
    

		];
        return view('recrutamento::candidato.form',compact('data','moduleInfo','menu'));
    }


    public function addEtapa($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        $candidato = Candidato::findOrFail($id);
        if(count($candidato->etapas()->get()) > 0){
            $model = $candidato;
            $itens_pedido = Candidato::findOrFail($id)->etapas()->get();
        }else{
            $model = null;
            $itens_pedido = [['id' => "",'nota'=>""]];
        }

        $data = [
            "url" 	 	=> url("recrutamento/candidato/addEtapa/"),
            'voltar'    => url("recrutamento/candidato/"),
			"pedido"	=> $model,
            "itens"		=> Etapa::all(),
            "itens_pedido"  => $itens_pedido,
            'title'		=> "Cadastrar Pedido",
            'candidato' => $candidato,

        ];
        


        return view('recrutamento::candidato.addetapa',compact('data','moduleInfo','menu'));
    }

    public function inserirEtapa(Request $request)
    {
        DB::beginTransaction();
		try{
            $candidato = Candidato::findOrFail($request->candidato_id);
            
            if(count($candidato->etapas()->get()) > 0){
                $candidato->etapas()->detach();
                $candidato->etapas()->attach($request->itens);
            }else{
                $candidato->etapas()->attach($request->itens);
            }

            
    
            DB::commit();
            return redirect('/recrutamento/candidato')->with('success', 'Etapa inserida com successo');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }


}
