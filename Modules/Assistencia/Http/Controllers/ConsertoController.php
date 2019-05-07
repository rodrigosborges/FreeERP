<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel, PecaAssistenciaModel, ServicoAssistenciaModel, ClienteAssistenciaModel};
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

     public function selecionarPeca($idos, $pecas, $servicos, $idpeca)
     {
        $teste =  '{{$id}}{{$pecas}} {{$servicos}}{{$peca->id}}';

       return view('assistencia::paginas.consertos.cadastrarconserto',compact('id','pecas','servicos', 'itens'));
     }
     public function salvar(Request $req){
        $dados  = $req->all();
        ConsertoAssistenciaModel::create($dados);

        return redirect()->route('consertos.index')->with('success','Ordem salva com sucesso!');
      }

     public function cadastrar(){
       $busca = '';
       $pecas = PecaAssistenciaModel::busca($busca);
       $servicos = ServicoAssistenciaModel::busca($busca);

       $ordens = ConsertoAssistenciaModel::all();
       if ($ordens == null):
         /*ATENÇÃO, TALVEZ ESTE IF NÃO SEJA NECESSARIO, APÓS FINALIZAR O FORM, TESTAR SEM A PARTE DE CIMA*/
         $id = 1;
         return view('assistencia::paginas.consertos.cadastrarconserto');
       else:

         $id = ConsertoAssistenciaModel::max();
         $id = $id + 1;
         return view('assistencia::paginas.consertos.cadastrarconserto',compact('id','pecas','servicos'));
      endif;

     }
     

     public function nomePecas(Request $req){
       return PecaAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',valor_venda) AS nomevenda"))->get()->pluck('nomevenda');
     }

     public function nomeServicos(Request $req){
       return ServicoAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',valor) AS nomemao"))->get()->pluck('nomemao');
     }

     public function nomeClientes(Request $req){
       return ClienteAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',cpf) AS nomecpf"))->get()->pluck('nomecpf');
     }


     public function dadosPecas(Request $req){
       [$nome, $valor] = explode('|',$req->input('nome'));
       return PecaAssistenciaModel::where('nome',$nome)->where('valor_venda',$valor)->select('id','nome','valor_venda')->first();
     }

     public function dadosServicos(Request $req){
       [$nome, $valor] = explode('|',$req->input('nome'));
       return ServicoAssistenciaModel::where('nome',$nome)->where('valor',$valor)->select('id','nome','valor')->first();
     }

     public function dadosCliente(Request $req){
       [$nome, $cpf] = explode('|',$req->input('nome'));
       return ClienteAssistenciaModel::where('nome',$nome)->where('cpf',$cpf)->select('id','nome','email','cpf','celnumero')->first();
     }

}
