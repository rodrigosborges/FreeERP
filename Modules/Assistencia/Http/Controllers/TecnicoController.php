<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\TecnicoAssistenciaModel;
class TecnicoController extends Controller
{

  public function index()
  {
    $tecnicos = TecnicoAssistenciaModel::all();
    return view('assistencia::paginas.tecnicos.localizartecnico',compact('tecnicos'));
  }
  public function localizar()
  {
    $tecnicos = TecnicoAssistenciaModel::all();
    return view('assistencia::paginas.tecnicos.localizartecnico',compact('tecnicos'));
  }
  public function cadastrar()
  {
    return view('assistencia::paginas.tecnicos.cadastrotecnico');
  }


  public function salvar(Request $req){
    $dados  = $req->all();
    TecnicoAssistenciaModel::create($dados);

    return redirect()->route('tecnico.localizar')->with('success','Técnico cadastrado com sucesso!');
  }

  public function editar($id)
  {
    $tecnico = TecnicoAssistenciaModel::find($id);
    return view('assistencia::paginas.tecnicos.editarTecnico',compact('tecnico'))->with('success','Técnico atualizado com sucesso!');
  }

  public function atualizar(Request $req, $id)
  {
    $dados  = $req->all();
    TecnicoAssistenciaModel::find($id)->update($dados);
    return redirect()->route('tecnico.localizar');
  }

  public function deletar($id)
  {
    $tecnico = TecnicoAssistenciaModel::find($id);
    $tecnico->all();
    $tecnico->update();

    return redirect()->route('tecnico.localizar');
  }

  public function buscar(Request $req)
  {
    $tecnicos = TecnicoAssistenciaModel::busca($req->busca);
    return view('assistencia::paginas.tecnicos.localizarTecnico',compact('tecnicos'));
  }


}
