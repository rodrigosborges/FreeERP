<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Recrutamento\Entities\{Vaga,Candidato,Cargo,Categoria};
use App\Entities\{Estado,Cidade,TipoTelefone,Telefone,Endereco};

class VagaController extends Controller
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
            ['icon' => 'assignment', 'tool' => 'Vagas', 'route' => '/recrutamento/vaga'],
            ['icon' => 'assignment', 'tool' => 'Vagas Disponíveis', 'route' => '/recrutamento/vagasDisponiveis'],
            ['icon' => 'assignment', 'tool' => 'Categorias', 'route' => '/recrutamento/categoria'],
            ['icon' => 'assignment', 'tool' => 'Cargos', 'route' => '/recrutamento/cargo'],
		];
    }




    public function index(Request $request)
    {
        if($request->pesquisa != ""){
            $pesquisaCargo = Cargo::where('categoria_id', '=', $request->pesquisa)->first();
            $pesquisaVaga = Vaga::where('cargo_id', '=' , $pesquisaCargo->id)->get();
            $pesquisaVagaInativa = Vaga::onlyTrashed()->where('cargo_id', '=' , $pesquisaCargo->id)->get();
        }else{
            $pesquisaVaga = Vaga::all();
            $pesquisaVagaInativa = Vaga::onlyTrashed()->get();
        }
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			'vagas'	=> $pesquisaVaga,
            'vagas_inativas'	=> $pesquisaVagaInativa,
            'title'		=> "Lista de Vagas",
            'categorias'    => Categoria::all(),
		]; 
        return view('recrutamento::vaga.index', compact('data','moduleInfo','menu'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			"url" 	 	=> url('recrutamento/vaga'),
			"button" 	=> "Salvar",
			"model"		=> null,
            'title'		=> "Cadastrar Vaga",
            'cargos'    => Cargo::all(), 
		];
        return view('recrutamento::vaga.form',compact('data','moduleInfo','menu'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
		try{
            
            $vaga = Vaga::Create($request->all());
            
			DB::commit();
			return redirect('/recrutamento/vaga')->with('success', 'Vaga cadastrada com sucesso');
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
			"url" 	 	=> url('recrutamento/vaga'),
			"button" 	=> "Candidatar-se",
			"model"		=> null,
            'title'		=> "Visualização de Vaga",
            'vaga'      => Vaga::findOrFail($id)
		];
        return view('recrutamento::vaga.show',compact('data','moduleInfo','menu'));
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
			"url" 	 	=> url("recrutamento/vaga/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Vaga::findOrFail($id),
            'title'		=> "Atualizar Vaga",
            'cargos'    => Cargo::all(),
		];
        return view('recrutamento::vaga.form',compact('data','moduleInfo','menu'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $salario = str_replace('.','',$request->salario);
        $salario = str_replace(',','.',$salario);
        $upVaga = array(
            'cargo' => $request->cargo,
            'status' => $request->status,
            'especificacoes' =>$request->especificacoes,
            'descricao' => $request->descricao,
            'salario' => $salario,
            'escolaridade'=>$request->escolaridade
        );
        DB::beginTransaction();
		try{
            $vaga = Vaga::findOrFail($id);
            $vaga->update($upVaga);
			DB::commit();
			return redirect('recrutamento/vaga')->with('success', 'Vaga atualizada com sucesso');
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
        DB::beginTransaction();
		try{    
            $vaga = Vaga::FindOrFail($id);
            $vaga->delete();          
			DB::commit();
			return redirect('/recrutamento/vaga')->with('success', 'Vaga deletada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function vagasDisponiveis(Request $request)
    {
        if($request->pesquisa != "" || $request->pesquisa != null){
            $pesquisaCargo = Cargo::where('categoria_id', '=', $request->pesquisa)->first();
            $pesquisa = Vaga::where([
                ['cargo_id', $pesquisaCargo->id],
                ['status', 1]
            ])->get();
        }else{
            $pesquisa = Vaga::where('status', '1')->get();
        }
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			'vagas'		=> $pesquisa,
            'title'		=> "Lista de Vagas Disponíveis",
            'categorias'    => Categoria::all(),
		]; 
        return view('recrutamento::vaga.vagasDisponiveis', compact('data','moduleInfo','menu'));
    }

    public function candidatos($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			'candidatos'		=> Candidato::where('vaga_id', $id)->get(),
			'candidatos_inativos'		=> Candidato::onlyTrashed()->where('vaga_id', $id)->get(),
			'title'		=> "Lista de Candidatos",
		]; 
        return view('recrutamento::vaga.candidatos', compact('data','moduleInfo','menu'));
    }

    public function restore($id)
    {
        DB::beginTransaction();
		try{    
            $vaga = Vaga::onlyTrashed()->where('id', $id)->first();
            $vaga->restore();          
			DB::commit();
			return redirect('/recrutamento/vaga')->with('success', 'Vaga restaurada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }


}
