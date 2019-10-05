<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Recrutamento\Entities\{Categoria,Cargo};
use Illuminate\Database\Eloquent\SoftDeletes;


class CategoriaController extends Controller
{
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
            ['icon' => 'assignment', 'tool' => 'Etapas', 'route' => '/recrutamento/etapa'],
            ['icon' => 'group', 'tool' => 'Candidatos', 'route' => '/recrutamento/candidato'],
		];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if($request->pesquisa != "" || $request->pesquisa != null){
            $pesquisa = Categoria::where('nome', 'like', '%'.$request->pesquisa.'%')->get();
            $pesquisa_inativos = Categoria::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->get();
        }else{
            $pesquisa = Categoria::all();
            $pesquisa_inativos = Categoria::onlyTrashed()->get();
        }
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'categorias'	=>  $pesquisa,
            'categorias_inativas'	=> $pesquisa_inativos,
            'title'		=> "Lista de Categorias",
            
		]; 
        return view('recrutamento::categoria.index', compact('data','moduleInfo','menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'url'       => url('recrutamento/categoria'), 
            'title'		=> "Cadastro de Categoria",
            'button'    => "Salvar",
            'model'     => null,
            "voltar"    => url('recrutamento/categoria'),
		]; 
        return view('recrutamento::categoria.form', compact('data','moduleInfo','menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
		try{    
            $categoria = Categoria::Create($request->all());          
			DB::commit();
			return redirect('/recrutamento/categoria')->with('success', 'Categoria cadastrada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'url'       => url('recrutamento/categoria/'.$id), 
            'title'		=> "Atualziação de Categoria",
            'button'    => "Atualizar",
            'model'     => Categoria::findOrFail($id),
            "voltar"    => url('recrutamento/categoria'),
		]; 
        return view('recrutamento::categoria.form', compact('data','moduleInfo','menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
		try{    
            $categoria = Categoria::FindOrFail($id);
            $categoria->update($request->all());          
			DB::commit();
			return redirect('/recrutamento/categoria')->with('success', 'Categoria atualizada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
		try{    
            $categoria = Categoria::FindOrFail($id);
            $categoria->delete();          
			DB::commit();
			return redirect('/recrutamento/categoria')->with('success', 'Categoria deletada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function restore($id)
    {
        DB::beginTransaction();
		try{    
            $categoria = Categoria::onlyTrashed()->where('id', $id)->first();
            $categoria->restore();          
			DB::commit();
			return redirect('/recrutamento/categoria')->with('success', 'Categoria restaurada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function pesquisa(Request $request)
    {
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'categorias'	=> $pesquisa,
            'categorias_inativas'	=> $pesquisa_inativos,
            'title'		=> "Lista de Categorias",
            
		]; 
        return view('recrutamento::categoria.index', compact('data','moduleInfo','menu'));
    }

}
