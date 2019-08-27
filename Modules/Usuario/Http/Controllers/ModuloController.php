<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Usuario\Entities\{Modulo};
use DB;

class ModuloController extends Controller
{
    protected $moduleInfo = [
        'icon' => 'person',
        'name' => 'Usuario'
    ];
    
    protected $menu = [
        ['icon' => 'add_circle', 'tool' => 'Cadastrar Usuário', 'route' => '/usuario/cadastrar'],
        ['icon' => 'add_circle', 'tool' => 'Cadastrar Módulo', 'route' => '/modulo/cadastrar'],
    ];

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('usuario::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        return view('usuario::modulo/form', compact('menu', 'moduleInfo'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            Modulo::create($request->all());
            DB::commit();
            return back()->with('sucesso', 'Módulo '.$request->nome.' cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            DB::rollback();
            return back()->with('erro', 'Erro ao cadastrar módulo '.$request->nome.': '.$e);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('usuario::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('usuario::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
