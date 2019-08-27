<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Usuario\Entities\Usuario;
use Modules\Usuario\Http\Requests\UsuarioRequest;
use DB;

class UsuarioController extends Controller
{
    protected $menu = [
        ['icon' => 'person', 'tool' => 'Usuário', 'route' => '/usuario'],
        ['icon' => 'add_circle', 'tool' => 'Módulo', 'route' => '/modulo'],
    ];

    protected $moduleInfo = [
        'icon' => 'person',
        'name' => 'Usuario'
    ];
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        $usuariosInativos = Usuario::onlyTrashed()->get();
        return view('usuario::usuario.index', compact('usuarios', 'usuariosInativos'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        return view('usuario::usuario.form', compact('menu', 'moduleInfo'));
        //return view('usuario::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(UsuarioRequest $request)
    {
        DB::beginTransaction();
        try{
        
            $usuario = Usuario::create($request->all());
            DB::commit();
    
            return back()->with('success', 'Usuário cadastrado com sucesso');
        }catch(\Exception $e){
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
        return view('usuario::usuario.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //return view('usuario::edit');
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;
        $usuario = Usuario::findOrFail($id);

        return view('usuario::usuario.form', compact('menu', 'moduleInfo', 'usuario'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(UsuarioRequest $request, $id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->update($request->all());
        return redirect('/usuario');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
       $usuario = Usuario::findOrFail($id);
       $usuario->delete();
       return back();
    }

    public function restore($id){
        $usuario = Usuario::onlyTrashed()->findOrFail($id);
        $usuario->restore();
        return back();
    }
}
