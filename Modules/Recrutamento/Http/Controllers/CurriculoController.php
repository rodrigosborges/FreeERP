<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Recrutamento\Entities\{Curriculo,Vaga};

class CurriculoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $moduleInfo = [
            'icon' => 'people',
            'name' => 'RECRUTAMENTO',
        ];
        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
		];
        $data = [
			'curriculo'		=> Curriculo::all(),
			'title'		=> "Lista de Curriculo",
		]; 
        return view('recrutamento::curriculo.curriculo', compact('data','moduleInfo','menu'));
    }

    public function create()
    {
        $moduleInfo = [
            'icon' => 'people',
            'name' => 'RECRUTAMENTO',
        ];
        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
		];
        $data = [
			"url" 	 	=> url("recrutamento/Curriculo/"),
			"button" 	=> "Salvar",
			"model"		=> null,
            'title'		=> "Cadastrar Curriculo",
            'vaga'      =>  Vaga::where('status', 'disponivel')->get()
		];
        return view('recrutamento::curriculo.formulario_curriculo',compact('data','moduleInfo','menu'));
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
			$curriculo = Curriculo::Create($request->all());
			DB::commit();
			return redirect('/recrutamento/Curriculo')->with('success', 'Curriculo cadastrada com sucesso');
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
        $curriculo = Curriculo::findOrFail($id);
	    return view('recrutamento::show', [
            'model' => $curriculo	    
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id,$vaga_id)
    {
        $moduleInfo = [
            'icon' => 'people',
            'name' => 'RECRUTAMENTO',
        ];
        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
            ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
		];
        $data = [
			"url" 	 	=> url("recrutamento/Curriculo/$vaga_id/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Curriculo::findOrFail($id),
			'title'		=> "Atualizar Curriculo"
		];
        return view('recrutamento::formulario_curriculo',compact('data','moduleInfo','menu'));
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
			$curriculo = Curriculo::findOrFail($id);
			$curriculo->update($request->all());
			DB::commit();
			return redirect('recrutamento/Curriculo')->with('success', 'Curriculo atualizado com sucesso');
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
        $curriculo = Curriculo::findOrFail($id);
		$curriculo->delete();
		return back()->with('success',  'Curriculo deletado'); 
    }
}
