<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Usuario\Entities\{Usuario,Papel};
use Modules\Usuario\Http\Requests\PapelRequest;
use DB;

class PapelController extends Controller
{

 
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {   
        
        $papeisInativos = Papel::onlyTrashed()->paginate(5);

        if ($request->has('busca')) {
            $busca = $request->get('busca');

                 $papeisAtivos = Papel::where('nome', 'like', "%{$busca}%")
                 ->paginate(5);
             $papeisAtivos->appends(['busca' => $busca]);
             return view('usuario::papel.index', compact('papeisAtivos', 'busca', 'papeisInativos'));
         }else{
            $papeisAtivos = Papel::paginate(5);
            return view('usuario::papel.index', compact('papeisAtivos', 'papeisInativos'));
         }
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('usuario::papel.form');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(PapelRequest $request)
    {
        DB::beginTransaction();
        try{
        
            $papel = Papel::create($request->all());
            DB::commit();
    
            return back()->with('success', 'Papel cadastrado com sucesso');
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
        return view('usuario::papel.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $papel = Papel::findOrFail($id);
        return view('usuario::papel.form', compact('papel'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(PapelRequest $request, $id)
    {
        $papel = Papel::findOrFail($id);
        $papel->update($request->all());
        return redirect('/papel');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $papel = Papel::findOrFail($id);
        if(!Usuario::where('papel_id', $id)->first()){
            $papel->delete();
            return back();
      
        }
        return redirect()->back()->with('error','Não é possível deletar um papel já atribuido');
      
    }

    public function restore($id){
        $papel = Papel::onlyTrashed()->findOrFail($id);
        $papel->restore();
        return redirect('/papel');
    }
    
    public function isUnique(Request $request,$id=null){
        $key = key($request->query());
        
        $field = Papel::where($key, $request->$key)->first();
     
        if($field && $id != $field->id ){
            return 'false';
        } else {
            return 'true';
        }
    }

    // public function search($nome){
    //     $papeis = Papel::where('nome', 'LIKE', '%'.$nome.'%')->get();
    //     $papeisInativos = Papel::onlyTrashed()->get();
    //     return view('usuario::papel.index', compact('papeis', 'papeisInativos'));

    // }
}
