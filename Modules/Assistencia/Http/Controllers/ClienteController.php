<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\ClienteAssistenciaModel;
use App\Entities\{ Endereco, Estado};
use Modules\Assistencia\Http\Requests\StoreClienteRequest;
use DB;

class ClienteController extends Controller
{

    public function index(){ //metodo get para lsitagem dos clientes
      DB::beginTransaction();
      try{
        $clientes = ClienteAssistenciaModel::paginate(10);
        $clientesDeletados = ClienteAssistenciaModel::onlyTrashed()->paginate(10);
        DB::commit();
        return view('assistencia::paginas.clientes.localizarCliente', compact('clientes','clientesDeletados'));
      } catch (\Exception $e) {
        
        DB::rollback();
        return view('assistencia::index')->with('error','Erro no servidor');
      }
    }

    public function cadastrar(){ //metodo get para o cadastro do cliente
      $estados = Estado::all(); //retorna os estados para o select de estados do form
      return view('assistencia::paginas.clientes.cadastroCliente', compact('estados'));
    }

    public function localizar(){ //metodo de retorno para a pagina de listagem do cliente
      DB::beginTransaction();
      try{
        $clientes = ClienteAssistenciaModel::paginate(10);
        $clientesDeletados = ClienteAssistenciaModel::onlyTrashed()->paginate(10);
        DB::commit();
        return view('assistencia::paginas.clientes.localizarCliente', compact('clientes','clientesDeletados'));
    
      } catch (\Exception $e) {
        
        DB::rollback();
        return view('assistencia::index')->with('error','Erro no servidor');
      }
    }

    public function salvar(StoreClienteRequest $req){ //Medodo store do cliente com parametro o request
      DB::beginTransaction();
      try {
        $dados  = $req->all();
        $endereco = Endereco::create($dados['endereco']); //cadastra o endereço na tabela de endereços
        $possivelCliente = ClienteAssistenciaModel::buscaCPF($dados['cpf']); //verifica se existe algum cliente com este cpf

        
        if( sizeof($possivelCliente) == 1){
          DB::commit();
          return back()->with('error','O cliente já possui um cadastro!');
        } elseif (sizeof($possivelCliente) > 1) {
          DB::commit();
          return back()->with('warning','Verifique a quantidade de clientes com esse CPF!');
        }else{
          ClienteAssistenciaModel::create([ //cria o cliente com os dados do request
            'nome' => $dados['nome'],
            'cpf' => $dados['cpf'],
            'email' => $dados['email'],
            'data_nascimento' => $dados['data_nascimento'],
            'celnumero' => $dados['celnumero'], 
            'telefonenumero' => isset($dados['telefonenumero']) ? $dados['telefonenumero'] : '',
            'endereco_id' => $endereco->id //vincula o cliente ao endereço
          ]);
          DB::commit();
          return redirect(route('cliente.localizar'))->with('success','Cliente cadastrado com sucesso!');
        }
      } catch (\Exception $e) {
        DB::rollback();
        return back();
      }
      
    }

    public function editar($id){ //metodo get para a edição do cliente
      $cliente = ClienteAssistenciaModel::withTrashed()->findOrFail($id);
      $estados = Estado::all();
      return view('assistencia::paginas.clientes.editarCliente',compact('cliente','estados'))->with('success','Cliente atualizado com sucesso!');
    }

    public function atualizar(StoreClienteRequest $req, $id){ // Medodo de update do cliente
      
      DB::beginTransaction();
      try {
        $dados  = $req->all();
        $cliente = ClienteAssistenciaModel::findOrFail($id);//encontra o cliente
        $cliente->endereco->update($dados['endereco']);//atualiza os dados do endereço
        $cliente->update($dados); //atualiza os dados do cliente
        
        DB::commit();
        return redirect()->route('cliente.localizar')->with('success','Cliente alterado com sucesso!');
      } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Erro no servidor.');
      }
      
    }

    public function deletar($id){ // Metodo de delete e restore do cliente
      $cliente = ClienteAssistenciaModel::withTrashed()->findOrFail($id);
      DB::beginTransaction();
      try {
        if($cliente->trashed()){ //verifica se o cliente esta apagado
          $cliente->restore();
          DB::commit();
          return back()->with('success','Cliente restaurado com sucesso!');
        }else {
          $cliente->delete();
          $cliente->update();
          DB::commit();
          return back()->with('success','Cliente deletado com sucesso!');
        }
        
      } catch (\Exception $e) {
        DB::rollback();
        return 'back()';
      }
      
    }
    //função abaixo é requisitada por ajax na view de localizar cliente
    public function table(Request $request){ //retorna table para amostra em view (requisitado por js)
      $clientes = new ClienteAssistenciaModel;
      $clientesDeletados = ClienteAssistenciaModel::onlyTrashed();

      if($request->busca){ //Verificar se existe valores de busca
        $clientes = $clientes->where('nome', 'LIKE', '%'.$request->busca.'%');
        $clientesDeletados = $clientesDeletados->where('nome', 'LIKE', '%'.$request->busca.'%');
      }

      $clientes = $clientes->paginate(10); 
      $clientesDeletados = $clientesDeletados->paginate(10);
      
      return view('assistencia::paginas.clientes._table', compact('clientes','clientesDeletados'));
    }


}
