<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Servico;

class ServicosController extends Controller
{
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
           return view('assistencia::paginas.estoque.cadastrarServico',compact('moduleInfo','menu'));
         }

         public function localizar()
         {
           $servicos = Servico::all();

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
           return view('assistencia::paginas.estoque.localizarServico',compact('moduleInfo','menu','servicos'));
         }

         public function salvar(Request $req)
         {
           $dados  = $req->all();
           Servico::create($dados);
           return redirect()->route('servicos.localizar');
         }

         public function editar($id)
         {
           $servico = Servico::find($id);

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
           return view('assistencia::paginas.estoque.editarServico',compact('moduleInfo','menu','servico'));
         }

         public function atualizar(Request $req, $id)
         {
           $dados  = $req->all();
           Servico::find($id)->update($dados);
           return redirect()->route('servicos.localizar');
         }

         public function deletar($id)
         {
           Servico::find($id)->delete();
           return redirect()->route('servicos.localizar');
         }
}
