<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel, PagamentoAssistenciaModel, PecaAssistenciaModel, ServicoAssistenciaModel, ClienteAssistenciaModel, TecnicoAssistenciaModel};
use DB;

class ConsertoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index()
     {
       return view('assistencia::paginas.conserto');
     }
     public function cadastrar(){
       $busca = '';
       $pecas = PecaAssistenciaModel::busca($busca);
       $servicos = ServicoAssistenciaModel::busca($busca);

       $ordens = ConsertoAssistenciaModel::all();

         $id = ConsertoAssistenciaModel::max();
         $id = $id + 1;
         return view('assistencia::paginas.consertos.cadastrarconserto',compact('id','pecas','servicos'));

     }

     public function localizar()
     {
       $consertos = ConsertoAssistenciaModel::all();
       return view('assistencia::paginas.consertos.localizarConserto',compact('consertos'));
     }
     public function buscar(Request $req)
     {
       $consertos = ConsertoAssistenciaModel::busca($req->busca);
       return view('assistencia::paginas.consertos.localizarConserto',compact('consertos'));
     }
/*
     public funcion calculaValor(pecas[], servicos[]) { 
        $valor = 0;
        if ( (pecas[] == null) and (servicos[] == null) ){
          return $valor;
        } else {
          foreach($pecas as $peca){
            $valor = $valor + $peca->valor_venda;
          }
          foreach($servicos as $servico) {
            $valor = $valor + $servico->valor;
          }
        }
       return $valor;
     }*/  

     public function visualizarConserto($id)
     {
       $conserto = ConsertoAssistenciaModel::find($id);
       return view('assistencia::paginas.consertos.vizualizarConserto',compact('conserto'));
     }
     public function editar($id)
     {
       $conserto = ConsertoAssistenciaModel::find($id);
       return view('assistencia::paginas.consertos.editarConserto',compact('conserto'));
     }
     
     public function salvar(Request $req){
      $dados  = $req->all();
      ConsertoAssistenciaModel::create($dados);
      $idConserto = $dados->id;
      PagamentoAssistenciaModel::create($idConserto);
      return redirect()->route('consertos.index')->with('success','Ordem salva com sucesso!');
      }

     public function nomeClientes(Request $req){
       return ClienteAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',cpf) AS nomecpf"))->get()->pluck('nomecpf');
     }
     public function nomeTecnicos(Request $req){
       return TecnicoAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',cpf) AS nomecpf"))->get()->pluck('nomecpf');
     }
     public function dadosCliente(Request $req){
       [$nome, $cpf] = explode('|',$req->input('nome'));
       return ClienteAssistenciaModel::where('nome',$nome)->where('cpf',$cpf)->select('id','nome','email','cpf','celnumero')->first();
     }
     public function dadosTecnico(Request $req){
       [$nome, $cpf] = explode('|',$req->input('nome'));
       return TecnicoAssistenciaModel::where('nome',$nome)->where('cpf',$cpf)->select('id','nome','cpf')->first();
     }

}
/* 
public function nomePecas(Request $req){
       return PecaAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',valor_venda) AS nomevenda"))->get()->pluck('nomevenda');
     }

     public function nomeServicos(Request $req){
       return ServicoAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',valor) AS nomemao"))->get()->pluck('nomemao');
     } 
public function dadosPecas(Request $req){
       [$nome, $valor] = explode('|',$req->input('nome'));
       return PecaAssistenciaModel::where('nome',$nome)->where('valor_venda',$valor)->select('id','nome','valor_venda')->first();
     }

     public function dadosServicos(Request $req){
       [$nome, $valor] = explode('|',$req->input('nome'));
       return ServicoAssistenciaModel::where('nome',$nome)->where('valor',$valor)->select('id','nome','valor')->first();
     }
*/