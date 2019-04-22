<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Cliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index()
    {
      $moduleInfo = [
          'icon' => 'smartphone',
          'name' => 'Assistência Técnica',
      ];

      $menu = [
          ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
          ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
          ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
          ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
      ];
      return view('assistencia::paginas.clientes',compact('moduleInfo','menu'));
    }

    public function cadastrar()
    {
      $moduleInfo = [
          'icon' => 'smartphone',
          'name' => 'Assistência Técnica',
      ];

      $menu = [
          ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
          ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
          ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
          ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
      ];
      return view('assistencia::paginas.clientes.cadastroCliente',compact('moduleInfo','menu'));
    }

    public function localizar()
    {
      $clientes = Cliente::all();

      $moduleInfo = [
          'icon' => 'smartphone',
          'name' => 'Assistência Técnica',
      ];

      $menu = [
          ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
          ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
          ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
          ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
      ];
      return view('assistencia::paginas.clientes.localizarCliente',compact('moduleInfo','menu','clientes'));
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

      $moduleInfo = [
          'icon' => 'smartphone',
          'name' => 'Assistência Técnica',
      ];

      $menu = [
          ['icon' => 'add_box', 'tool' => 'Cadastrar', 'route' => '/'],
          ['icon' => 'search', 'tool' => 'Buscar', 'route' => '#'],
          ['icon' => 'edit', 'tool' => 'Editar', 'route' => '#'],
          ['icon' => 'delete', 'tool' => 'Remover', 'route' => '#'],
      ];
      return view('assistencia::paginas.clientes.editarCliente',compact('moduleInfo','menu','cliente'));
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



}
