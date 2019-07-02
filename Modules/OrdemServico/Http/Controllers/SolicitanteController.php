<?php

namespace Modules\OrdemServico\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class SolicitanteController extends Controller
{
    public function index()
    {
        return view('ordemservico::index');
    }

    public function create()
    {
        return view('ordemservico::create');
    }
   public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('ordemservico::show');
    }

    public function edit($id)
    {
        return view('ordemservico::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
