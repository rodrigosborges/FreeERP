<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Concerto;
class ConcertoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index()
     {
       $moduleInfo = [
           'icon' => 'android',
           'name' => 'Assistência Técnica',
       ];

       $menu = [
           ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
           ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
           ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
           ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
       ];

       return view('assistencia::paginas.concerto',compact('moduleInfo','menu'));
     }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('assistencia::create');
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
        return view('assistencia::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('assistencia::edit');
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
