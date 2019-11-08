<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\{ConsertoAssistenciaModel,SituacaoOsModel,ItemPeca, PagamentoAssistenciaModel, PecaAssistenciaModel, ServicoAssistenciaModel, ClienteAssistenciaModel, TecnicoAssistenciaModel, PecaOs, ItemServico};
use DB;
use Modules\Assistencia\Http\Requests\StoreConsertosRequest;

class ConsertoController extends Controller
{
    public function index() { //metodo get para listagem de OS's
      
      return view('assistencia::paginas.conserto');
    }

    public function cadastrar(){ //metodo get para a criação da OS
      $pecas = ItemPeca::all();
      $servicos = ServicoAssistenciaModel::all();
      $clientes = ClienteAssistenciaModel::all();
      $tecnicos = TecnicoAssistenciaModel::all();
      $pecaOS = [];
      $itemServico = [];

      if(count($clientes) != 0 && count($tecnicos) != 0) {
        $ultimo = ConsertoAssistenciaModel::withTrashed()->latest()->first();
        $id = 0;

        if($ultimo == null){
          $id = 1;
        } else {
          $id = 1 + $ultimo->id;
        }
        return view('assistencia::paginas.consertos.cadastrarconserto', compact('id','pecaOS','itemServico','clientes','tecnicos','pecas','servicos'));
      
      } else if (count($clientes) == 0){
        $consertos = ConsertoAssistenciaModel::paginate(10);
        return redirect()->route('consertos.index')->with('error' , 'Nenhum cliente ativo na base de dados');
      } else {
        $consertos = ConsertoAssistenciaModel::paginate(10);
        return redirect()->route('consertos.index')->with('error' , 'Nenhum técnico ativo na base de dados');
      }
      
    }

    public function localizar() { //GET de listagem de OS
       $consertos = ConsertoAssistenciaModel::paginate(10);

       return view('assistencia::paginas.consertos.localizarConserto', compact('consertos'));
    }

    public function buscar(Request $req) { //Metodo de busca para listagem de OS.. melhoria do método em js (ex. Cliente)
       $consertos = ConsertoAssistenciaModel::busca($req->busca);

       return view('assistencia::paginas.consertos.localizarConserto', compact('consertos'));
    }

    public function visualizarConserto($id) { //GET para informações gerais da OS
       $conserto = ConsertoAssistenciaModel::findOrFail($id);
       $pecaOS = PecaOs::where('idConserto', $id)->get();
       $itemServico = itemServico::where('idConserto', $id)->get();

       return view('assistencia::paginas.consertos.visualizarConserto', compact('conserto', 'pecaOS','itemServico'));
    }
    public function imprimir($id) { //GET geração de PDF da OS
      $conserto = ConsertoAssistenciaModel::findOrFail($id);
       $pecaOS = PecaOs::where('idConserto', $id)->get();
       $itemServico = itemServico::where('idConserto', $id)->get();

      return \PDF::loadView('assistencia::paginas.consertos.checklist', compact('conserto', 'pecaOS','itemServico'))->stream();
                
    }
    public function editar($id) { //GET pagina de edição da OS
      $conserto = ConsertoAssistenciaModel::findOrFail($id);
      $conserto['sinal'] = str_replace(".",",", $conserto ['sinal']);
      $pecas = ItemPeca::all();
      $servicos = ServicoAssistenciaModel::all();
      $tecnicos = TecnicoAssistenciaModel::all();
      $clientes = ClienteAssistenciaModel::all();
      $pecaOS = PecaOs::where('idConserto', $id)->get();
      $itemServico = itemServico::where('idConserto', $id)->get();

      return view('assistencia::paginas.consertos.editarConserto', compact('conserto', 'clientes', 'id', 'pecas', 'servicos','pecaOS','itemServico','tecnicos'));
    }
    
    public function verMais($id){ //GET informações adicionais da OS
      $infos = SituacaoOsModel::where('idConserto', $id)->paginate(10);

      return view('assistencia::paginas.consertos.verMais', compact('infos'));
    }
    public function excluirVerMais ($id){ //DELETE para informações adicionais da OS
      if($id != 1){
        SituacaoOsModel::where('id', $id)->delete();
        return back()->with('success', 'Informação deletada com sucesso.');
      }else {
        return back()->with('danger', 'Não é possivel apagar a primeira observação');
      }

    }

    public function salvar(StoreConsertosRequest $req){ //POST/store da OS

      $dados  = $req->all();
      $dados['valor'] = str_replace(",",".",$dados['valor']);
      if($dados['sinal'])
        $dados['sinal'] = str_replace(",",".",$dados['sinal']);
        
      $conserto = ConsertoAssistenciaModel::create($dados);
      $idConserto = $conserto->id;
      PagamentoAssistenciaModel::create([
        'idConserto' => $conserto->id,
        'idCliente' => $conserto->idCliente,
        'valor' => ($dados['sinal']) ? $dados['valor']-$dados['sinal'] : $dados['valor'],
        'status' => 'Pendente',
        'forma' => 'Não pago'
      ]);
      SituacaoOsModel::create([
        'situacao' => $dados['situacao'],
        'obs' => 'Criação da ordem deserviço.',
        'idConserto' => $conserto->id
      ]);

      if(isset($dados['pecas']) ? true : false){
        for ($i=0; $i < count($dados['pecas']); $i++) {
          $pecas = new PecaOs;
          $pecas->idConserto = $idConserto;
          $pecas->idItemPeca = $dados['pecas'][$i];
          $pecas->save();
        }
      }
      
      if(isset($dados['servicos']) ? true : false){
        for ($i=0; $i < count($dados['servicos']); $i++) {
          $servicos = new ItemServico;
          $servicos->idConserto = $idConserto;
          $servicos->idMaoObra = $dados['servicos'][$i];
          $servicos->save();
        }
      }

      return redirect()->route('consertos.localizar')->with('success','Ordem de serviço iniciada!');
      
    }
    public function atualizar(Request $req, $id){ //PUT/update da OS
     
      $dados  = $req->all();
      $dados['valor'] = str_replace(",",".",$dados['valor']);
      if($dados['sinal'])
        $dados['sinal'] = str_replace(",",".",$dados['sinal']);
       ConsertoAssistenciaModel::findOrFail($id)->update($dados);
       $conserto = ConsertoAssistenciaModel::findOrFail($id);
   
      $pagamento = PagamentoAssistenciaModel::findOrFail($id);
      $pagamento->update(['valor' => ($conserto['valor']) ? $conserto['valor']- $conserto['sinal'] : $conserto['valor']]);
  
      SituacaoOsModel::create([
        'situacao' => $dados['situacao'],
        'obs' =>  $dados['obsInfo'] !=  '' ? $dados['obsInfo'] : 'Alteração de dados' ,
        'idConserto' => $conserto->id
      ]);
      $pecaOS = PecaOs::where('idConserto', $id)->get();
      $itemServico = ItemServico::where('idConserto', $id)->get();
      foreach($pecaOS as $item){
        $item->forceDelete();
      }
      if(isset($dados['pecas']) ? true : false){
        
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
      if(isset($dados['servicos']) ? true : false){
        for ($i=0; $i < count($dados['servicos']); $i++) {
          $servicos = new ItemServico;
          $servicos->idConserto = $id;
          $servicos->idMaoObra = $dados['servicos'][$i];
          $servicos->save();
        }
      }

      return redirect()->route('consertos.localizar')->with('success','Ordem de serviço alterada com sucesso');
  }

    public function nomeClientes(Request $req){ //Retorna o cliente no select do formulario da OS

      return ClienteAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',cpf) AS nomecpf"))->get()->pluck('nomecpf');
    }
    public function nomeTecnicos(Request $req){ //Retorna o tecnico no select do formilario da OS

      return TecnicoAssistenciaModel::where('nome','LIKE', "%".$req->input('nome')."%")->select(DB::raw("CONCAT(nome,'|',cpf) AS nomecpf"))->get()->pluck('nomecpf');
    }
    public function dadosCliente(Request $req){ //Retorna dados do cliente 
       [$nome, $cpf] = explode('|',$req->input('nome'));
       return ClienteAssistenciaModel::where('nome',$nome)->where('cpf',$cpf)->select('id','nome','email','cpf','celnumero')->first();
    }

    public function dadosTecnico(Request $req){ //Retorna dados do tecnico
       [$nome, $cpf] = explode('|',$req->input('nome'));
       return TecnicoAssistenciaModel::where('nome',$nome)->where('cpf',$cpf)->select('id','nome','cpf')->first();
    }

    public function finalizar($id){ //Metodo de finalização da ordem

      $pagamento =  PagamentoAssistenciaModel::where('idConserto', $id)->get()->first();
      

      return view('assistencia::paginas.pagamentos.finalizarPagamento', compact('pagamento'));
    }

}

