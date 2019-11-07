<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\TecnicoAssistenciaModel;
use Modules\Assistencia\Http\Requests\StoreTecnicoRequest;
use DB;

class TecnicoController extends Controller
{

  public function index(){
    $tecnicos = TecnicoAssistenciaModel::paginate(10);
    $tecnicosDeletados = TecnicoAssistenciaModel::onlyTrashed()->paginate(10);

    return view('assistencia::paginas.tecnicos.localizartecnico',compact('tecnicos','tecnicosDeletados'));
  }
  public function localizar(){
    $tecnicos = TecnicoAssistenciaModel::paginate(10);
    $tecnicosDeletados = TecnicoAssistenciaModel::onlyTrashed()->paginate(10);
    return view('assistencia::paginas.tecnicos.localizartecnico',compact('tecnicos','tecnicosDeletados'));
  }
  public function cadastrar(){
    return view('assistencia::paginas.tecnicos.cadastrotecnico');
  }
  public function salvar(StoreTecnicoRequest $req){
    DB::beginTransaction();
      try {
        $dados  = $req->all();
        TecnicoAssistenciaModel::create($dados);
        DB::commit();
        return redirect()->route('tecnico.localizar')->with('success','Técnico cadastrado com sucesso!');
        
      } catch (\Exception $e) {
        DB::rollback();
        return back();
      }
    
  }

  public function editar($id){
    $tecnico = TecnicoAssistenciaModel::find($id);
    return view('assistencia::paginas.tecnicos.editarTecnico',compact('tecnico'))->with('success','Técnico atualizado com sucesso!');
  }

  public function atualizar(StoreTecnicoRequest $req, $id){
    DB::beginTransaction();
      try {
        $dados  = $req->all();
        TecnicoAssistenciaModel::find($id)->update($dados);
        DB::commit();

        return redirect()->route('tecnico.localizar')->with('success','Técnico atualizado com sucesso!'); 
      } catch (\Exception $e) {
        DB::rollback();
        return back();
      }
    
  }

  public function deletar($id){
    DB::beginTransaction();
    $tecnico = TecnicoAssistenciaModel::withTrashed()->find($id);
      try {
        
        if($tecnico->trashed()){
          $tecnico->restore();
          DB::commit();
          return back()->with('success','Técnico restaurado com sucesso');
        }else {
          $tecnico->delete();
          $tecnico->update();
          DB::commit();
          return back()->with('success','Técnico deletado com sucesso');
        }
        
      } catch (\Exception $e) {
        DB::rollback();
        return back();
      }
    
  }

  public function buscar(Request $req){
    $tecnicos = TecnicoAssistenciaModel::busca($req->busca)->paginate(10);
    $tecnicosDeletados = TecnicoAssistenciaModel::busca($req->busca)->onlyTrashed()->paginate(10);
    
    return view('assistencia::paginas.tecnicos.localizarTecnico',compact('tecnicos','tecnicosDeletados'));
  }


}
