<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\ClienteAssistenciaModel;
use Modules\Assistencia\Http\Requests\StoreClienteRequest;
use DB;

class ClienteController extends Controller
{

    public function index(){
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

    public function cadastrar(){
      return view('assistencia::paginas.clientes.cadastroCliente');
    }

    public function localizar(){
      $clientes = ClienteAssistenciaModel::paginate(10);
      return view('assistencia::paginas.clientes.localizarCliente',compact('clientes'));
    }

    public function salvar(StoreClienteRequest $req){
      DB::beginTransaction();
      try {
        
        $dados  = $req->all();
        $possivelCliente = ClienteAssistenciaModel::buscaCPF($dados['cpf']);

        
        if( sizeof($possivelCliente) == 1){
          DB::commit();
          return back()->with('error','O cliente já possui um cadastro!');
          //redirect()->route('cliente.localizar') nao funciona
        } elseif (sizeof($possivelCliente) > 1) {
          DB::commit();
          return back()->with('warning','Verifique a quantidade de clientes com esse CPF!');
        }else{
          ClienteAssistenciaModel::create($dados);
          DB::commit();
          return back()->with('success','Cliente cadastrado com sucesso!');
        }
      } catch (\Exception $e) {
        DB::rollback();
        return back();
      }
      
    }

    public function editar($id){
      $cliente = ClienteAssistenciaModel::withTrashed()->findOrFail($id);
      return view('assistencia::paginas.clientes.editarCliente',compact('cliente'))->with('success','Cliente atualizado com sucesso!');
    }

    public function atualizar(StoreClienteRequest $req, $id){
      DB::beginTransaction();
      try {
        $dados  = $req->all();
        ClienteAssistenciaModel::findOrFail($id)->update($dados);
        DB::commit();
        return redirect()->route('cliente.localizar')->with('success','Cliente alterado com sucesso!');
      } catch (\Exception $e) {
        DB::rollback();
        return back();
      }
      
    }

    public function deletar($id){
      $cliente = ClienteAssistenciaModel::withTrashed()->findOrFail($id);
      DB::beginTransaction();
      try {
        if($cliente->trashed()){
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

    public function buscar(Request $req){
      $clientes = ClienteAssistenciaModel::busca($req->busca);
      
      return view('assistencia::paginas.clientes.localizarCliente', compact('clientes'));
    }


}
