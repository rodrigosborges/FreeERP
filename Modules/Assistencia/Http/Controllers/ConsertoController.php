<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel,ItemPeca, PagamentoAssistenciaModel, PecaAssistenciaModel, ServicoAssistenciaModel, ClienteAssistenciaModel, TecnicoAssistenciaModel, PecaOs, ItemServico};
use DB;
use Modules\Assistencia\Http\Requests\StoreConsertosRequest;

class ConsertoController extends Controller
{
    public function index() {

      return view('assistencia::paginas.conserto');
    }

    public function cadastrar(){
      $pecas = ItemPeca::all();
      $servicos = ServicoAssistenciaModel::all();
      $clientes = ClienteAssistenciaModel::all();
      $tecnicos = TecnicoAssistenciaModel::all();

      if(count($clientes) != 0 && count($tecnicos) != 0) {
        $ultimo = ConsertoAssistenciaModel::withTrashed()->latest()->first();
        $id = 0;

        if($ultimo == null){
          $id = 1;
        } else {
          $id = 1 + $ultimo->id;
        }
        return view('assistencia::paginas.consertos.cadastrarconserto', compact('id','clientes','tecnicos','pecas','servicos'));
      
      } else if (count($clientes) == 0){
        $consertos = ConsertoAssistenciaModel::paginate(10);
        return redirect()->route('consertos.index')->with('error' , 'Nenhum cliente ativo na base de dados');
      } else {
        $consertos = ConsertoAssistenciaModel::paginate(10);
        return redirect()->route('consertos.index')->with('error' , 'Nenhum técnico ativo na base de dados');
      }
      
    }

    public function localizar() {
       $consertos = ConsertoAssistenciaModel::paginate(10);

       return view('assistencia::paginas.consertos.localizarConserto', compact('consertos'));
    }

    public function buscar(Request $req) {
       $consertos = ConsertoAssistenciaModel::busca($req->busca);

       return view('assistencia::paginas.consertos.localizarConserto', compact('consertos'));
    }

    public function visualizarConserto($id) {
       $conserto = ConsertoAssistenciaModel::find($id);
       $pecaOS = PecaOs::where('idConserto', $id)->get();
       $itemServico = itemServico::where('idConserto', $id)->get();

       return view('assistencia::paginas.consertos.visualizarConserto', compact('conserto', 'pecaOS','itemServico'));
    }
    public function imprimir($id) {
      $conserto = ConsertoAssistenciaModel::find($id);
       $pecaOS = PecaOs::where('idConserto', $id)->get();
       $itemServico = itemServico::where('idConserto', $id)->get();
      //  $html = view('assistencia::paginas.consertos.checklist', compact('conserto', 'pecaOS','itemServico'));
      //  $pdf = App::make('dompdf.wrapper');
      //  $pdf->loadHTML($html);
      //  return $pdf->stream();

      return \PDF::loadView('assistencia::paginas.consertos.checklist', compact('conserto', 'pecaOS','itemServico'))->stream();
                
    }
    public function editar($id) {
      $conserto = ConsertoAssistenciaModel::find($id);
      $pecas = ItemPeca::all();
      $servicos = ServicoAssistenciaModel::all();
      $tecnicos = TecnicoAssistenciaModel::all();
      $clientes = ClienteAssistenciaModel::all();
      $pecaOS = PecaOs::where('idConserto', $id)->get();
      $itemServico = itemServico::where('idConserto', $id)->get();

      return view('assistencia::paginas.consertos.editarConserto', compact('conserto', 'clientes', 'id', 'pecas', 'servicos','pecaOS','itemServico','tecnicos'));
    }
    public function atualizar(Request $req, $id){
     
        $dados  = $req->all();
        ConsertoAssistenciaModel::find($id)->update($dados);

        $conserto = ConsertoAssistenciaModel::find($id)->latest()->first();
        $pagamento = PagamentoAssistenciaModel::find($id);
        $pagamento->valor = $conserto->valor;
        $pagamento->save();
       
        $pecaOS = PecaOs::where('idConserto', $id)->get();
        $itemServico = ItemServico::where('idConserto', $id)->get();
        
        
        foreach($pecaOS as $item){
          $item->forceDelete();
        }
        if($dados['pecas']){
          
          for ($i=0; $i < count($dados['pecas']); $i++) {
            $pecas = new PecaOs;
            $pecas->idConserto = $id;
            $pecas->idItemPeca = $dados['pecas'][$i];
            $pecas->save();
          }
        }
        foreach($itemServico as $item){
          $item->forceDelete();
        }
        if($dados['servicos']){
          
          for ($i=0; $i < count($dados['servicos']); $i++) {
            $servicos = new ItemServico;
            $servicos->idConserto = $id;
            $servicos->idMaoObra = $dados['servicos'][$i];
            $servicos->save();
          }
        }
        
        

       
        return redirect()->route('consertos.localizar')->with('success','Ordem de serviço alterada com sucesso');
      
      
      
    }

    public function salvar(StoreConsertosRequest $req){
      
      $dados  = $req->all();
      //REALIZAR VERIFICAÇÃO DE PEÇA E MAO DE OBRA VAZIOS, E GERAR UM VALOR PADRAO

      ConsertoAssistenciaModel::create($dados);
      $conserto = ConsertoAssistenciaModel::latest()->first();
      $idConserto = $conserto->id;
      $pagamento = new PagamentoAssistenciaModel;
      $pagamento->idConserto = $conserto->id;
      $pagamento->idCliente = $conserto->idCliente;
      $pagamento->valor = $conserto->valor;
      $pagamento->status = 'Pendente';
      $pagamento->forma = 'Não pago';
      $pagamento->save();

      if($dados['pecas']){
        for ($i=0; $i < count($dados['pecas']); $i++) {
          $pecas = new PecaOs;
          $pecas->idConserto = $idConserto;
          $pecas->idItemPeca = $dados['pecas'][$i];
          $pecas->save();
        }
      }
      if($dados['servicos']){
        for ($i=0; $i < count($dados['servicos']); $i++) {
          $servicos = new ItemServico;
          $servicos->idConserto = $idConserto;
          $servicos->idMaoObra = $dados['servicos'][$i];
          $servicos->save();
        }
      }

      return redirect()->route('consertos.localizar')->with('success','Ordem de serviço iniciada!');
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

    public function finalizar($id){

      $pagamento =  PagamentoAssistenciaModel::where('idConserto', $id)->get()->first();

      return view('assistencia::paginas.pagamentos.finalizarPagamento', compact('pagamento'));
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
