<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
       
    //EXIBE AS VIEWS
    public function index(){
        // Passe os parâmetros definidos utilizando as chaves 'moduleInfo' e 'menu'
        
        return view('eventos::index');
    }
    
    public function eventos(){
        // Passe os parâmetros definidos utilizando as chaves 'moduleInfo' e 'menu'
        
        return view('eventos::eventos');
    }
    
    public function pessoas(){
        // Passe os parâmetros definidos utilizando as chaves 'moduleInfo' e 'menu'
        return view('eventos::pessoas');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('eventos::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('eventos::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('eventos::edit');
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
