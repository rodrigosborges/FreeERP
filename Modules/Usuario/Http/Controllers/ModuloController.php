<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use Modules\Usuario\Http\Requests\ModuloRequest;

use Modules\Usuario\Entities\{Modulo, Papel};
use DB;

class ModuloController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $modulosAtivos = Modulo::all();
        $modulosInativos = Modulo::onlyTrashed()->get();

        if($request->has('busca')) {
            $busca = $request->get('busca');
            
            $modulosAtivos = Modulo::where('nome', 'like', "%{$busca}%")->get();
            $modulosInativos = Modulo::onlyTrashed()->where('nome', 'like', "%{$busca}%")->get();
            
            return view('usuario::modulo.index', compact(
                'modulosAtivos',
                'modulosInativos',
                'busca'
            ));
        }

        return view('usuario::modulo.index', compact(
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
        $papeis = Papel::all();
        return view('usuario::modulo.form', compact('papeis'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(ModuloRequest $request)
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
        $modulo = Modulo::findOrFail($id);
        return view('usuario::modulo.form', compact('modulo'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(ModuloRequest $request, $id)
    {
        $modulo = Modulo::findOrFail($id);
        $modulo->update($request->all());

        return redirect('modulo/'.$modulo->id.'/edit')->with('success', 'Módulo '.$modulo->nome.' alterado com sucesso!');
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

    public function restore($id){
        $modulo = Modulo::onlyTrashed()->findOrFail($id);
        $modulo->restore();
        return back();
    }
    
    public function isUnique(Request $request,$id=null){
        $key = key($request->query());
        
        $field = Modulo::where($key, $request->$key)->first();
     
        if($field && $id != $field->id ){
            return 'false';
        } else {
            return 'true';
        }
    }
}
