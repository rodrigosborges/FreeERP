<?php

namespace Modules\Usuario\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Usuario\Entities\Papel;
use Modules\Usuario\Http\Requests\PapelRequest;
use DB;

class PapelController extends Controller
{

 
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $papeis = Papel::all();
        $papeisInativos = Papel::onlyTrashed()->get();
        return view('usuario::papel.index', compact('papeis', 'papeisInativos'));
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
    public function store(Request $request)
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
        return view('usuario::papel.form');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
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
        $papel->delete();
        return back();
    }

    public function restore($id){
        $papel = Papel::onlyTrashed()->findOrFail($id);
        $papel->restore();
        return back();
    }
}
