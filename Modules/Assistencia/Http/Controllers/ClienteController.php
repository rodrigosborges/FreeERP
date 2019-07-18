<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\ClienteAssistenciaModel;
use Modules\Assistencia\Http\Requests\StoreClienteRequest;

class ClienteController extends Controller
{

    public function index(){
      $clientes = ClienteAssistenciaModel::paginate(10);
      return view('assistencia::paginas.clientes.localizarCliente',compact('clientes'));
    }

    public function cadastrar(){
      return view('assistencia::paginas.clientes.cadastroCliente');
    }

    public function localizar(){
      $clientes = ClienteAssistenciaModel::paginate(10);
      return view('assistencia::paginas.clientes.localizarCliente',compact('clientes'));
    }

    public function salvar(StoreClienteRequest $req){
      $dados  = $req->all();
      $possivelCliente = ClienteAssistenciaModel::buscaCPF($dados['cpf']);
      if( sizeof($possivelCliente) == 1){
        return redirect()->route('cliente.localizar')->with('error','O cliente já possui um cadastro!');

      } elseif (sizeof($possivelCliente) > 1) {
        return redirect()->route('cliente.localizar')->with('warning','Verifique a quantidade de clientes com esse CPF!');
      }else{
        ClienteAssistenciaModel::create($dados);
        return redirect()->route('cliente.localizar')->with('success','Cliente cadastrado com sucesso!');
      }
    }

    public function editar($id){
      $cliente = ClienteAssistenciaModel::find($id);
      return view('assistencia::paginas.clientes.editarCliente',compact('cliente'))->with('success','Cliente atualizado com sucesso!');
    }

    public function atualizar(StoreClienteRequest $req, $id){
      $dados  = $req->all();
      ClienteAssistenciaModel::find($id)->update($dados);

      return redirect()->route('cliente.localizar')->with('success','Cliente alterado com sucesso!');
    }

    public function deletar($id){
      $cliente = ClienteAssistenciaModel::find($id);
      $cliente->delete();
      $cliente->update();

      return redirect()->route('cliente.localizar')->with('success','Cliente deletado com sucesso!');
    }

    public function buscar(Request $req){
      $clientes = ClienteAssistenciaModel::busca($req->busca);
      
      return view('assistencia::paginas.clientes.localizarCliente', compact('clientes'));
    }


}
