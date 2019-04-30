<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Cliente_assistencia;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index()
    {

      return view('assistencia::paginas.clientes');
    }

    public function cadastrar()
    {

      return view('assistencia::paginas.clientes.cadastroCliente');
    }

    public function localizar()
    {
      $clientes = Cliente::all();


      return view('assistencia::paginas.clientes.localizarCliente',compact('clientes'));
    }

    public function salvar(Request $req)
    {
      $dados  = $req->all();
      Cliente::create($dados);
      return redirect()->route('cliente.localizar');
    }

    public function editar($id)
    {
      $cliente = Cliente::find($id);


      return view('assistencia::paginas.clientes.editarCliente',compact('cliente'));
    }

    public function atualizar(Request $req, $id)
    {
      $dados  = $req->all();
      Cliente::find($id)->update($dados);
      return redirect()->route('cliente.localizar');
    }

    public function deletar($id)
    {
      Cliente::find($id)->delete();
      return redirect()->route('cliente.localizar');
    }

    public function buscar(Request $req)
    {
      $clientes = Cliente::busca($req->busca);


      return view('assistencia::paginas.clientes.localizarCliente',compact('clientes'));

    }


}
