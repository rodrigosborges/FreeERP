<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\PecaAssistenciaModel;
use Modules\Assistencia\Http\Requests\StorePecaRequest;

class PecasController extends Controller
{

   public function cadastrar(){

     return view('assistencia::paginas.estoque.cadastrarPeca');
   }

   public function localizar(){
     $pecas = PecaAssistenciaModel::paginate(10);

     return view('assistencia::paginas.estoque.localizarPeca',compact('pecas'));
   }

   public function salvar(StorePecaRequest $req){
     $dados  = $req->all();
     PecaAssistenciaModel::create($dados);
     return redirect()->route('pecas.localizar');
   }

   public function editar($id){
     $peca = PecaAssistenciaModel::find($id);


     return view('assistencia::paginas.estoque.editarPeca',compact('peca'));
   }

   public function atualizar(StorePecaRequest $req, $id){
     $dados  = $req->all();
     PecaAssistenciaModel::find($id)->update($dados);
     return redirect()->route('pecas.localizar');
   }

   public function deletar($id){
      $peca = PecaAssistenciaModel::find($id);
      $peca->delete();
      $peca->update();

     return redirect()->route('pecas.localizar');
   }
   public function buscar(Request $req){
     $pecas = PecaAssistenciaModel::busca($req->busca);


     return view('assistencia::paginas.estoque.localizarPeca',compact('pecas'));

   }
}
