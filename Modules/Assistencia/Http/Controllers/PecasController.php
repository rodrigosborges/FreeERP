<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Peca;

class PecasController extends Controller
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
           return view('assistencia::paginas.estoque.cadastrarPeca',compact('moduleInfo','menu'));
         }

         public function localizar()
         {
           $pecas = Peca::all();

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
           return view('assistencia::paginas.estoque.localizarPeca',compact('moduleInfo','menu','pecas'));
         }

         public function salvar(Request $req)
         {
           $dados  = $req->all();
           Peca::create($dados);
           return redirect()->route('pecas.localizar');
         }

         public function editar($id)
         {
           $peca = Peca::find($id);

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
           return view('assistencia::paginas.estoque.editarPeca',compact('moduleInfo','menu','peca'));
         }

         public function atualizar(Request $req, $id)
         {
           $dados  = $req->all();
           Peca::find($id)->update($dados);
           return redirect()->route('pecas.localizar');
         }

         public function deletar($id)
         {
           Peca::find($id)->delete();
           return redirect()->route('pecas.localizar');
         }
}
