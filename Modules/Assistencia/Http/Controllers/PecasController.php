<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\PecaAssistenciaModel;

class PecasController extends Controller
{

         public function cadastrar()
         {

           return view('assistencia::paginas.estoque.cadastrarPeca');
         }

         public function localizar()
         {
           $pecas = PecaAssistenciaModel::where('ativo', 1)->get();;

           return view('assistencia::paginas.estoque.localizarPeca',compact('pecas'));
         }

         public function salvar(Request $req)
         {
           $dados  = $req->all();
           PecaAssistenciaModel::create($dados);
           return redirect()->route('pecas.localizar');
         }

         public function editar($id)
         {
           $peca = PecaAssistenciaModel::find($id);


           return view('assistencia::paginas.estoque.editarPeca',compact('peca'));
         }

         public function atualizar(Request $req, $id)
         {
           $dados  = $req->all();
           PecaAssistenciaModel::find($id)->update($dados);
           return redirect()->route('pecas.localizar');
         }

         public function deletar($id)
         {
            $peca = PecaAssistenciaModel::find($id);
            $peca->ativo = 0;
            $peca->update();

           return redirect()->route('pecas.localizar');
         }
         public function buscar(Request $req)
         {
           $pecas = PecaAssistenciaModel::busca($req->busca);


           return view('assistencia::paginas.estoque.localizarPeca',compact('pecas'));

         }
}
