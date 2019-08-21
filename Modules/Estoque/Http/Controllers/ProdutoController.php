<?php

namespace Modules\Estoque\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;
use Modules\Estoque\Http\Requests\ProdutoRequest;
use Modules\Estoque\Entities\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        return view('estoque::Produto.index');
    }

    public function create()
    {
        return view('estoque::produto.form');
    }

    public function store(ProdutoRequest $request)
    {
        DB::beginTransaction();
        try{
            Produto::create($request->all());
            DB::commit();
            return redirect('/')->with('success', 'Produto cadastrado com sucesso');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Erro no servidor');
        }
    }

    public function edit($id)
    {
        return view('estoque::produto.form');
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
