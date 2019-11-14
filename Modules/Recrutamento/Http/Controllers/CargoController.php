<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Recrutamento\Entities\{Cargo,Categoria};
use Modules\Recrutamento\Http\Requests\{CargoRequest};


class CargoController extends Controller
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
            ['icon' => 'email', 'tool' => 'Emails', 'route' => '/recrutamento/email'],
            ['icon' => 'power_settings_new', 'tool' => 'Logout', 'route' => '/logout'],
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
            $pesquisa = Cargo::where('nome', 'like', '%'.$request->pesquisa.'%')->get();
            $pesquisa_inativos = Cargo::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->get();

            if(count($pesquisa) == 0 && count($pesquisa) == 0){
                
                $id = Categoria::where('nome', 'like', '%'.$request->pesquisa.'%')->first()->id;
                if($id == ''){
                    $id = Categoria::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->first()->id;
                }

                $pesquisa = Cargo::where('categoria_id', '=', $id)->get();
                $pesquisa_inativos = Cargo::onlyTrashed()->where('categoria_id', '=', $id )->get();

            }
        }else{
            $pesquisa = Cargo::all();
            $pesquisa_inativos = Cargo::onlyTrashed()->get();
        }
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'cargos'	=> $pesquisa,
            'cargos_inativos'	=>  $pesquisa_inativos,
            'title'		=> "Lista de Cargos",
            
		]; 
        return view('recrutamento::cargo.index', compact('data','moduleInfo','menu'));
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
            'url'       => url('recrutamento/cargo'), 
            'title'		=> "Cadastro de Cargo",
            'button'    => "Salvar",
            'model'     => null,
            'voltar'    => url('recrutamento/cargo'),
            'categorias'=> Categoria::all(),
		]; 
        return view('recrutamento::cargo.form', compact('data','moduleInfo','menu'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request)
    {
        $cargos = Cargo::all();
        foreach($cargos as $cargo){
            if(strtoupper($request->nome) == strtoupper($cargo->nome)){
                return back()->with('error', 'Nome de cargo já existe');
            }
        }
        DB::beginTransaction();
		try{    
            $cargo = Cargo::Create($request->all());          
			DB::commit();
			return redirect('/recrutamento/cargo')->with('success', 'Cargo cadastrada com sucesso');
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
            'url'       => url('recrutamento/cargo/'.$id), 
            'title'		=> "Atualziação de Cargo",
            'button'    => "Atualizar",
            'model'     => Cargo::findOrFail($id),
            'categorias'     => Categoria::all(),
            "voltar"    => url('recrutamento/cargo'),
		]; 
        return view('recrutamento::cargo.form', compact('data','moduleInfo','menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CargoRequest $request, $id)
    {
        $cargos = Cargo::all();
        foreach($cargos as $cargo){
            if($cargo->id != $id){
                if(strtoupper($request->nome) == strtoupper($cargo->nome)){
                    return back()->with('error', 'Nome de cargo já existe');
                }
            }
        }
        DB::beginTransaction();
		try{    
            $cargo = Cargo::FindOrFail($id);
            $cargo->update($request->all());          
			DB::commit();
			return redirect('/recrutamento/cargo')->with('success', 'Cargo atualizada com sucesso');
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
            $cargo = Cargo::FindOrFail($id);
            $cargo->delete();          
			DB::commit();
			return redirect('/recrutamento/cargo')->with('success', 'Cargo deletado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function restore($id)
    {
        DB::beginTransaction();
		try{    
            $cargo = Cargo::onlyTrashed()->where('id', $id)->first();
            $cargo->restore();          
			DB::commit();
			return redirect('/recrutamento/cargo')->with('success', 'Cargo restaurado com sucesso');
		}catch(Exception $e){
			DB::rollback();
			return back()->with('error', 'Erro no servidor');
		}
    }

    public function pesquisa(Request $request)
    {
        $pesquisa = Cargo::where('nome', 'like', '%'.$request->pesquisa.'%')->get();
        $pesquisa_inativos = Cargo::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->get();

        if(count($pesquisa) == 0 && count($pesquisa) == 0){
            
            $id = Categoria::where('nome', 'like', '%'.$request->pesquisa.'%')->first()->id;
            if($id == ''){
                $id = Categoria::onlyTrashed()->where('nome', 'like', '%'.$request->pesquisa.'%')->first()->id;
            }

            $pesquisa = Cargo::where('categoria_id', '=', $id)->get();
            $pesquisa_inativos = Cargo::onlyTrashed()->where('categoria_id', '=', $id )->get();

        }



        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
            'cargos'	=> $pesquisa,
            'cargos_inativos'	=> $pesquisa_inativos,
            'title'		=> "Lista de Cargos",
            
		]; 
        return view('recrutamento::cargo.index', compact('data','moduleInfo','menu'));
    }
}
