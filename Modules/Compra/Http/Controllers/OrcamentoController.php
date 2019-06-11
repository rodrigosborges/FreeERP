<?php

namespace Modules\Compra\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class OrcamentoController extends Controller
{
    
    protected $moduleInfo;
    protected $menu;

    public function  __construct(){
        $this->moduleInfo = [
            'icon' => 'store',
            'name' => 'COMPRA',
        ];
        $this->menu = [
		];
    }

    public function index()
    {
        
        $moduleInfo = $this->moduleInfo;
        $menu = $this->menu;

        return view('compra::orcamento.formulario', compact('moduleInfo','menu'));
    }

    public function create()
    {
        return view('compra::create');
    }

    public function store(Request $request)
    {
        
    }

    public function show($id)
    {
        return view('compra::show');
    }

    public function edit($id)
    {
        return view('compra::edit');
    }

    public function update(Request $request, $id)
    {
        
    }

    public function destroy($id)
    {
    
    }
}
