<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Eventos\Entities\Evento;
use App\Entities\Estado;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
       
    //EXIBE AS VIEWS
    public function index(){
        $eventos = Evento::all();
        $estados = Estado::all();
        return view('eventos::index', ['eventos' => $eventos,'estados' => $estados]);
    }
    
    public function exibir(){
        $eventos = Evento::all();
        $estados = Estado::all();
        return view('eventos::eventos', ['eventos' => $eventos,'estados' => $estados]);
    }
    
    public function cadastrar(Request $request)
    {
        $evento = new Evento();
        $evento->nome = $request->nome;
        $evento->local = $request->local;
        $evento->dataInicio = $request->dataInicio;
        $evento->dataFim = $request->dataFim;
        $evento->descricao = $request->descricao;
        $evento->empresa = $request->empresa;
        $evento->email = $request->email;
        $evento->telefone = $request->telefone;
        
        if ($request->hasFile('imgEvento')){
            $arquivo = $request->imgEvento;
            $extensao = $arquivo->getClientOriginalExtension();
            $nomeArquivo = time() . '.' . $extensao;
            $upload = $request->imgEvento->storeAs('eventos', $nomeArquivo);
            $evento->imagem = $nomeArquivo;
        } else {
            $evento->imagem = '';
        }
        
        $evento->save(); 
        
        return redirect()->route('eventos.exibir')
            ->with('success', $request->nome . ' adicionado(a) com sucesso.');
    }
    
    public function editar(Request $request)
    {
        $evento = Evento::find($request->id);
        $evento->update(['nome' => $request->nome, 'local' => $request->local,'dataInicio' => $request->dataInicio, 'dataFim' => $request->dataFim, 'descricao' => $request->descricao, 'empresa' => $request->empresa, 'email' => $request->email, 'telefone' => $request->telefone]);
        
        if ($request->hasFile('imgEvento')){
            $arquivo = $request->imgEvento;
            $extensao = $arquivo->getClientOriginalExtension();
            $nomeArquivo = time() . '.' . $extensao;
            $upload = $request->imgEvento->storeAs('eventos', $nomeArquivo);
            $evento->update(['imagem' => $nomeArquivo]);
        }
        
        return redirect()->route('eventos.exibir')
            ->with('success', $request->nome . ' alterado(a) com sucesso.');
    }
    
    public function excluir(Request $request)
    {
        $evento = Evento::find($request->id);
        $evento->pessoas()->detach();
        $evento->delete();
        return redirect()->route('eventos.exibir')
            ->with('success', $evento->nome . ' excluído(a) com sucesso.');
    }
    
}
