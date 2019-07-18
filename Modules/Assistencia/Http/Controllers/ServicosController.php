<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\ServicoAssistenciaModel;
use Modules\Assistencia\Http\Requests\StoreServicoRequest;

class ServicosController extends Controller
{
  public function cadastrar(){
     return view('assistencia::paginas.estoque.cadastrarServico');
  }

   public function localizar(){
     $servicos = ServicoAssistenciaModel::paginate(10);

     return view('assistencia::paginas.estoque.localizarServico',compact('servicos'));
   }

   public function salvar(StoreServicoRequest $req){
     $dados  = $req->all();
     $dados['valor'] = str_replace(",",".",$dados['valor']);
     ServicoAssistenciaModel::create($dados);
     return redirect()->route('servicos.localizar');
   }

   public function editar($id){
     $servico = ServicoAssistenciaModel::find($id);
     return view('assistencia::paginas.estoque.editarServico',compact('servico'));
   }

   public function atualizar(StoreServicoRequest $req, $id){
     $dados  = $req->all();
     ServicoAssistenciaModel::find($id)->update($dados);
     return redirect()->route('servicos.localizar');
   }

   public function deletar($id){
    $servico = ServicoAssistenciaModel::find($id);
    $servico->delete();
    $servico->update();

    return redirect()->route('servicos.localizar');
   }
   public function buscar(Request $req){
     $servicos = ServicoAssistenciaModel::busca($req->busca);

     return view('assistencia::paginas.estoque.localizarServico',compact('servicos'));

   }
}
