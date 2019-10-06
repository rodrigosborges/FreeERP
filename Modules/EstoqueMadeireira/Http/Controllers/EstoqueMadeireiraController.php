<?php

namespace Modules\EstoqueMadeireira\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class EstoqueMadeireiraController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $moduleInfo = [
            'icon' => 'android',
            'name' => 'Estoque Madeireira',
        ];

        $menu = [
            ['icon' => 'add_box', 'tool' => 'Cadastro', 'route' => '/'],
            ['icon' => 'search', 'tool' => 'Pedidos', 'route' => '#'],
            ['icon' => 'edit', 'tool' => 'Estoque', 'route' => '#'],
            //['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
        ];

        return view('estoquemadeireira::index',compact('moduleInfo','menu'));     
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('estoquemadeireira::create');
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
        return view('estoquemadeireira::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('estoquemadeireira::edit');
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
