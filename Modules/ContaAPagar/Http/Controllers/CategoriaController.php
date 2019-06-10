<?php

namespace Modules\ContaAPagar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContaAPagar\Entities\CategoriaModel;

class CategoriaController extends Controller
{

    public function index(){
        $categorias = CategoriaModel::where('ativo', 1)->get();
        return view('contaapagar::categorias', compact('categorias'));
    }

    public function salvar(Request $request)
    {
        $dados = $request->all();
        CategoriaModel::create($dados);

        $categorias = CategoriaModel::where('ativo', 1)->get();
        return view('contaapagar::categorias', compact('categorias'))->with('success','A categoria foi cadastrado com sucesso!');
    }

    
    public function deletar($id){
        $categoria = CategoriaModel::find($id);
        $categoria->ativo = false;
        $categoria->update();
        return $this->index();
    }    
    
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('contaapagar::show');
    }

    
    public function edit($id)
    {
        return view('contaapagar::edit');
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
