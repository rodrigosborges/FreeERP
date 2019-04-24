<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Servico;

class ServicosController extends Controller
{
    public function cadastrar()
         {
           
           return view('assistencia::paginas.estoque.cadastrarServico');
         }

         public function localizar()
         {
           $servicos = Servico::all();

           return view('assistencia::paginas.estoque.localizarServico',compact('servicos'));
         }

         public function salvar(Request $req)
         {
           $dados  = $req->all();
           Servico::create($dados);
           return redirect()->route('servicos.localizar');
         }

         public function editar($id)
         {
           $servico = Servico::find($id);

           return view('assistencia::paginas.estoque.editarServico',compact('servico'));
         }

         public function atualizar(Request $req, $id)
         {
           $dados  = $req->all();
           Servico::find($id)->update($dados);
           return redirect()->route('servicos.localizar');
         }

         public function deletar($id)
         {
           Servico::find($id)->delete();
           return redirect()->route('servicos.localizar');
         }
         public function buscar(Request $req)
         {
           $servicos = Servico::busca($req->busca);

           return view('assistencia::paginas.estoque.localizarServico',compact('servicos'));

         }
}
