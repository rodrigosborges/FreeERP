<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Recrutamento\Entities\{Beneficio};
use Illuminate\Database\Eloquent\SoftDeletes;

class BeneficioController extends Controller
{
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

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        if($request->pesquisa != "" || $request->pesquisa != null){
            $pesquisa = Beneficio::where('nome', 'like', '%'.$request->pesquisa.'%')->get();
            $pesquisa_inativos = Beneficio::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->get();
        }else{
            $pesquisa = Beneficio::all();
            $pesquisa_inativos = Beneficio::onlyTrashed()->get();
        }
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'beneficios'	=>  $pesquisa,
            'beneficios_inativos'	=> $pesquisa_inativos,
            'title'		=> "Lista de Benefícios",
            
		]; 
        return view('recrutamento::beneficio.index', compact('data','moduleInfo','menu'));
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
            'url'       => url('recrutamento/beneficio'), 
            'title'		=> "Cadastro de Benefício",
            'button'    => "Salvar",
            'model'     => null,
            "voltar"    => url('recrutamento/beneficio'),
		]; 
        return view('recrutamento::beneficio.form', compact('data','moduleInfo','menu'));
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
            $etapa = Beneficio::Create($request->all());          
			DB::commit();
			return redirect('/recrutamento/beneficio')->with('success', 'Benefício cadastrada com sucesso');
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
            'url'       => url('recrutamento/beneficio/'.$id), 
            'title'		=> "Atualziação de Benefício",
            'button'    => "Atualizar",
            'model'     => Beneficio::findOrFail($id),
            "voltar"    => url('recrutamento/beneficio'),
		]; 
        return view('recrutamento::beneficio.form', compact('data','moduleInfo','menu'));
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
            $beneficio = Beneficio::FindOrFail($id);
            $beneficio->update($request->all());          
			DB::commit();
			return redirect('/recrutamento/beneficio')->with('success', 'Benefício atualizada com sucesso');
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
            $beneficio = Beneficio::FindOrFail($id);
            $beneficio->delete();          
			DB::commit();
			return redirect('/recrutamento/beneficio')->with('success', 'Benefício deletada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function restore($id)
    {
        DB::beginTransaction();
		try{    
            $beneficio = Beneficio::onlyTrashed()->where('id', $id)->first();
            $beneficio->restore();          
			DB::commit();
			return redirect('/recrutamento/beneficio')->with('success', 'Benefício restaurada com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }
}
