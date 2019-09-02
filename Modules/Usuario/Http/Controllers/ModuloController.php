<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Usuario\Entities\{Modulo};
use DB;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $todosModulos = Modulo::withTrashed()->get();
        $modulosAtivos = Modulo::all();
        $modulosInativos = Modulo::onlyTrashed()->get();

        return view('usuario::modulo.index', compact(
            'todosModulos',
            'modulosAtivos',
            'modulosInativos'
        ));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('usuario::modulo.form');
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
            return back()->with('success', 'Módulo '.$request->nome.' cadastrado com sucesso!');
        }
        catch(\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Erro ao cadastrar módulo '.$request->nome.': '.$e);
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
        $modulo = Modulo::findOrFail($id);
        $modulo->delete();
        return back();
    }
}
