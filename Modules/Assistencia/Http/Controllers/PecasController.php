<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Peca_assistencia;

class PecasController extends Controller
{

         public function cadastrar()
         {

           return view('assistencia::paginas.estoque.cadastrarPeca');
         }

         public function localizar()
         {
           $pecas = Peca::all();

           return view('assistencia::paginas.estoque.localizarPeca',compact('pecas'));
         }

         public function salvar(Request $req)
         {
           $dados  = $req->all();
           Peca::create($dados);
           return redirect()->route('pecas.localizar');
         }

         public function editar($id)
         {
           $peca = Peca::find($id);


           return view('assistencia::paginas.estoque.editarPeca',compact('peca'));
         }

         public function atualizar(Request $req, $id)
         {
           $dados  = $req->all();
           Peca::find($id)->update($dados);
           return redirect()->route('pecas.localizar');
         }

         public function deletar($id)
         {
           Peca::find($id)->delete();
           return redirect()->route('pecas.localizar');
         }
         public function buscar(Request $req)
         {
           $pecas = Peca::busca($req->busca);


           return view('assistencia::paginas.estoque.localizarPeca',compact('pecas'));

         }
}
