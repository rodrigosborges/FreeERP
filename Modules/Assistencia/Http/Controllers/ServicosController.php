<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\ServicoAssistenciaModel;
use Modules\Assistencia\Http\Requests\StoreServicoRequest;
use DB;

class ServicosController extends Controller
{
  public function cadastrar(){
     return view('assistencia::paginas.estoque.cadastrarServico');
  }

   public function localizar(){ //Listagem de serviços/mao de obra 
     $servicos = ServicoAssistenciaModel::paginate(10);
     $servicosDeletados = ServicoAssistenciaModel::onlyTrashed()->paginate(10);
     return view('assistencia::paginas.estoque.localizarServico',compact('servicos','servicosDeletados'));
   }

   public function salvar(StoreServicoRequest $req){ //Store de um novo serviço
    DB::beginTransaction();
    try {
      $dados  = $req->all();
      $dados['valor'] = str_replace(",",".",$dados['valor']);
      $dados['valor'] = str_replace("R$","",$dados['valor']);
      ServicoAssistenciaModel::create($dados);
      DB::commit();
      return redirect()->route('servicos.localizar');
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
     
   }

   public function editar($id){ //GET para ediçao de um serviço
     $servico = ServicoAssistenciaModel::find($id);
     $servico ['valor'] = str_replace(".",",",$servico ['valor']);
     
     return view('assistencia::paginas.estoque.editarServico',compact('servico'));
   }

   public function atualizar(StoreServicoRequest $req, $id){ //UPDATE de um serviço
    DB::beginTransaction();
    try {
      $dados  = $req->all();
      $dados['valor'] = str_replace(",",".",$dados['valor']);

      ServicoAssistenciaModel::find($id)->update($dados);
      DB::commit();
      return redirect()->route('servicos.localizar');
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
     
   }

   public function deletar($id){ //DELETE para um serviço
    DB::beginTransaction();
    try {
      $servico = ServicoAssistenciaModel::find($id);
      $servico->delete();
      $servico->update();
      DB::commit();
      return redirect()->route('servicos.localizar');
      
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
    
   }
   public function buscar(Request $req){ //Método de busca de serviços
     $servicos = ServicoAssistenciaModel::busca($req->busca);

     return view('assistencia::paginas.estoque.localizarServico',compact('servicos'));

   }
}
