<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Entities\{Endereco,Estado,Cidade, Email, Telefone, TipoTelefone};
use Modules\Recrutamento\Entities\{Candidato,Vaga,};

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
            ['icon' => 'assignment', 'tool' => 'Vaga', 'route' => '/recrutamento/vaga'],
            ['icon' => 'assignment', 'tool' => 'Vagas Disponíveis', 'route' => '/recrutamento/vagasDisponiveis'],
		];
    }




    
    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'candidatos'	=> Candidato::all(),
			'title'		=> "Lista de Curriculo"
		]; 
        return view('recrutamento::candidato.index', compact('data','moduleInfo','menu'));
    }

    public function create()
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
  
        if($request->hasFile('curriculum') && $request->file('curriculum')->isValid() && $request->curriculum->extension() == 'pdf'){
            $nome = md5($request->candidato['nome'].date('Y-m-d H:i'));
            $extensao = $request->curriculum->extension();
            $nameFile = "{$nome}.{$extensao}";
            $curriculum = $nameFile;

            $upload = $request->curriculum->storeAs('curriculos', $nameFile);
            if(!$upload){
                return redirect()->back()->with('error', 'Falha no upload do curriculum');
            }
        }
        else{
            return redirect()->back()->with('error', 'Falha, formato de curriculum inválido');
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
			"button" 	=> "Marcar Entrevista",
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
		return back()->with('success',  'Curriculo deletado'); 
    }
}
