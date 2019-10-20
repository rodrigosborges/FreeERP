<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\PecaAssistenciaModel;
use Modules\Assistencia\Entities\ItemPeca;
use Modules\Assistencia\Http\Requests\StorePecaRequest;
use DB;

class PecasController extends Controller
{

   public function cadastrar(){

     return view('assistencia::paginas.estoque.cadastrarPeca');
   }

  public function localizar(){
     $pecas = PecaAssistenciaModel::paginate(10);
     $pecasDeletadas = PecaAssistenciaModel::onlyTrashed()->paginate(10);

   

     
     
     return view('assistencia::paginas.estoque.localizarPeca',compact('pecas','pecasDeletadas'));
  }

  public function salvar(StorePecaRequest $req){
    DB::beginTransaction();
      try {
        $dados = $req->all();
        $dados['valor_venda'] = str_replace(".","",$dados['valor_venda']);
        $dados['valor_venda'] = str_replace(",",".",$dados['valor_venda']);
        $dados['valor_venda'] = str_replace("R$","",$dados['valor_venda']);
        $dados['valor_compra'] = str_replace(".","",$dados['valor_compra']);
        $dados['valor_compra'] = str_replace(",",".",$dados['valor_compra']);
        $dados['valor_compra'] = str_replace("R$","",$dados['valor_compra']);
        $quantidade = intval($dados['quantidade']);
        PecaAssistenciaModel::create($dados);
        $peca = PecaAssistenciaModel::latest()->first();
        for($i = 1; $i <= $quantidade; $i++ ){
          $itemPeca = new ItemPeca;
          $itemPeca->idPeca = $peca->id;
          $itemPeca->save();
        }
        DB::commit();
        return redirect()->route('pecas.localizar');
      } catch (\Exception $e) {
        DB::rollback();
        return back();
      }
    
  }

   public function editar($id){
      $peca = PecaAssistenciaModel::find($id);
      $itens = ItemPeca::where('idPeca', $id)->paginate(10);
      $peca ['valor_compra'] = str_replace(".",",",$peca ['valor_compra']);
      $peca ['valor_venda'] = str_replace(".",",",$peca ['valor_venda']);

     return view('assistencia::paginas.estoque.editarPeca',compact('peca','itens'));
   }

   public function atualizar(StorePecaRequest $req, $id){
    DB::beginTransaction();
    try {
      $dados  = $req->all();
      $dados['valor_venda'] = str_replace(",",".",$dados['valor_venda']);
      $dados['valor_compra'] = str_replace(",",".",$dados['valor_compra']);
      PecaAssistenciaModel::find($id)->update($dados);
      DB::commit();
      return redirect()->route('pecas.localizar');
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
     
   }

   public function deletar($id){
    DB::beginTransaction();
    try {
      $peca = PecaAssistenciaModel::find($id);
      $peca->delete();
      $peca->update();
      DB::commit();
      return redirect()->route('pecas.localizar');
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
      
   }
   public function deletarItem($id){
    DB::beginTransaction();
    try {
      
      $item = ItemPeca::find($id);
      $item->delete();
      $item->update();
      $peca = PecaAssistenciaModel::where('id', $item->idPeca)->get()->first();
      $peca->quantidade = ($peca->quantidade)-1;
      $peca->update();
      DB::commit();
      return redirect()->route('pecas.editar', $item->idPeca);
    } catch (\Exception $e) {
      DB::rollback();
      return back();
    }
    
 }
   public function buscar(Request $req){
     $pecas = PecaAssistenciaModel::busca($req->busca);
     return view('assistencia::paginas.estoque.localizarPeca',compact('pecas'));

   }
}
