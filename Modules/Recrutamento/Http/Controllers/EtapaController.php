<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Recrutamento\Entities\{Etapa};
use Illuminate\Database\Eloquent\SoftDeletes;

class EtapaController extends Controller
{

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
            ['icon' => 'assignment', 'tool' => 'Etapas', 'route' => '/recrutamento/etapa'],
            ['icon' => 'group', 'tool' => 'Candidatos', 'route' => '/recrutamento/candidato'],
		];
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->pesquisa != "" || $request->pesquisa != null){
            $pesquisa = Etapa::where('nome', 'like', '%'.$request->pesquisa.'%')->get();
            $pesquisa_inativos = Etapa::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->get();
        }else{
            $pesquisa = Etapa::all();
            $pesquisa_inativos = Etapa::onlyTrashed()->get();
        }
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'etapas'	=>  $pesquisa,
            'etapas_inativas'	=> $pesquisa_inativos,
            'title'		=> "Lista de Etapas",
            
		]; 
        return view('recrutamento::etapa.index', compact('data','moduleInfo','menu'));
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
            'url'       => url('recrutamento/etapa'), 
            'title'		=> "Cadastro de Etapa",
            'button'    => "Salvar",
            'model'     => null,
            "voltar"    => url('recrutamento/etapa'),
		]; 
        return view('recrutamento::etapa.form', compact('data','moduleInfo','menu'));
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
            $etapa = Etapa::Create($request->all());          
			DB::commit();
			return redirect('/recrutamento/etapa')->with('success', 'Etapa cadastrada com sucesso');
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
       // 
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
            'url'       => url('recrutamento/etapa/'.$id), 
            'title'		=> "Atualziação de Etapa",
            'button'    => "Atualizar",
            'model'     => Etapa::findOrFail($id),
            "voltar"    => url('recrutamento/etapa'),
		]; 
        return view('recrutamento::etapa.form', compact('data','moduleInfo','menu'));
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
            $etapa = Etapa::FindOrFail($id);
            $etapa->update($request->all());          
			DB::commit();
			return redirect('/recrutamento/etapa')->with('success', 'Etapa atualizada com sucesso');
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
            $etapa = Etapa::FindOrFail($id);
            $etapa->delete();          
			DB::commit();
			return redirect('/recrutamento/etapa')->with('success', 'Etapa deletada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function restore($id)
    {
        DB::beginTransaction();
		try{    
            $etapa = Etapa::onlyTrashed()->where('id', $id)->first();
            $etapa->restore();          
			DB::commit();
			return redirect('/recrutamento/etapa')->with('success', 'Etapa restaurada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

}
