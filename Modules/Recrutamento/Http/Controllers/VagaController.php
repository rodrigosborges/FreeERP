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
    protected $moduleInfo;
    protected $menu;
    public function  __construct(){
        $this->moduleInfo = [
            'icon' => 'people',
            'name' => 'RECRUTAMENTO',
        ];
        $this->menu = [
            ['icon' => 'assignment', 'tool' => 'Vaga', 'route' => '/recrutamento/Vaga'],
            ['icon' => 'assignment', 'tool' => 'Vagas Disponíveis', 'route' => '/recrutamento/vagasDisponiveis'],
		];
    }




    public function index()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			'vaga'		=> Vaga::all(),
			'title'		=> "Lista de Vagas",
		]; 
        return view('recrutamento::vaga.vaga', compact('data','moduleInfo','menu'));
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
			"url" 	 	=> url('recrutamento/Vaga'),
			"button" 	=> "Salvar",
			"model"		=> null,
			'title'		=> "Cadastrar Vaga"
		];
        return view('recrutamento::vaga.formulario_vaga',compact('data','moduleInfo','menu'));
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
            
            //$vaga = Vaga::Create($request->all());
            $salario = str_replace('.','',$request->salario);
            $salario = str_replace(',','.',$salario);
            $vaga = new Vaga;
            $vaga->salario = $salario;
            $vaga->cargo = $request->cargo;
            $vaga->status = $request->status;
            $vaga->descricao = $request->descricao;
            $vaga->escolaridade = $request->escolaridade;
            $vaga->save();
            
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
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			"url" 	 	=> url("recrutamento/Vaga/$id"),
			"button" 	=> "Atualizar",
			"model"		=> Vaga::findOrFail($id),
			'title'		=> "Atualizar Vaga"
		];
        return view('recrutamento::vaga.formulario_vaga',compact('data','moduleInfo','menu'));
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
            'descricao' => $request->descricao,
            'salario' => $salario,
            'escolaridade'=>$request->escolaridade
        );
        DB::beginTransaction();
		try{
            $vaga = Vaga::findOrFail($id);
            $vaga->update($upVaga);
			DB::commit();
			return redirect('recrutamento/Vaga')->with('success', 'Vaga atualizada com sucesso');
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

    public function vagas_disponiveis()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $data = [
			'vaga'		=> Vaga::where('status', 'disponivel')->get(),
			'title'		=> "Lista de Vagas Disponíveis",
		]; 
        return view('recrutamento::vaga.vagas_disponiveis', compact('data','moduleInfo','menu'));
    }


}
