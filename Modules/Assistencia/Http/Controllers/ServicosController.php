<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\ServicoAssistenciaModel;

class ServicosController extends Controller
{
    public function cadastrar()
         {

           return view('assistencia::paginas.estoque.cadastrarServico');
         }

         public function localizar()
         {
           $servicos = ServicoAssistenciaModel::all();

           return view('assistencia::paginas.estoque.localizarServico',compact('servicos'));
         }

         public function salvar(Request $req)
         {
           $dados  = $req->all();
           ServicoAssistenciaModel::create($dados);
           return redirect()->route('servicos.localizar');
         }

         public function editar($id)
         {
           $servico = ServicoAssistenciaModel::find($id);

           return view('assistencia::paginas.estoque.editarServico',compact('servico'));
         }

         public function atualizar(Request $req, $id)
         {
           $dados  = $req->all();
           ServicoAssistenciaModel::find($id)->update($dados);
           return redirect()->route('servicos.localizar');
         }

         public function deletar($id)
         {
           ServicoAssistenciaModel::find($id)->delete();
           return redirect()->route('servicos.localizar');
         }
         public function buscar(Request $req)
         {
           $servicos = ServicoAssistenciaModel::busca($req->busca);

           return view('assistencia::paginas.estoque.localizarServico',compact('servicos'));

         }
}
