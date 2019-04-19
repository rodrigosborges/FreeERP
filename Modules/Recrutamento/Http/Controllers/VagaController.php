<?php

namespace Modules\Recrutamento\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Modules\Recrutamento\Entities\{Vaga};

class VagaController extends Controller
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
			'vaga'		=> Vaga::all(),
			'title'		=> "Lista de Vagas",
		]; 
        return view('recrutamento::vaga', compact('data','moduleInfo','menu'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
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
			"url" 	 	=> url('recrutamento/Vaga'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar Vaga"
		];
        return view('recrutamento::formulario_vaga',compact('data','moduleInfo','menu'));
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
			return redirect('/recrutamento/Vaga')->with('success', 'Vaga cadastrada com sucesso');
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
        $vaga = Vaga::findOrFail($id);
	    return view('recrutamento::show', [
            'model' => $vaga	    
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
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
			"url" 	 	=> url("recrutamento/Vaga/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Vaga::findOrFail($id),
			'title'		=> "Atualizar Vaga"
		];
        return view('recrutamento::formulario_vaga',compact('data','moduleInfo','menu'));
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
			$vaga = Vaga::findOrFail($id);
			$vaga->update($request->all());
			DB::commit();
			return redirect('recrutamento/Vaga')->with('success', 'Item atualizado com sucesso');
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
        $vaga = Vaga::findOrFail($id);
		$vaga->delete();
		return back()->with('success',  'Vaga deletada'); 
    }
}
