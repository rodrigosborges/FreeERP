<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Eventos\Entities\Evento;
use Modules\Eventos\Entities\Estado;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
       
    //EXIBE AS VIEWS
    public function index(){
        $eventos = DB::table('evento')
                ->join('cidade', 'evento.cidade_id', '=', 'cidade.id')
                ->join('estado', 'cidade.estado_id', '=', 'estado.id')
                ->select('evento.id','nome','local','dataInicio','dataFim','descricao','imagem','empresa','email','telefone','cidade_id','nomeCidade','estado_id','nomeEstado','uf')
                ->get();
        $estados = Estado::all();
        return view('eventos::index', ['eventos' => $eventos,'estados' => $estados]);
    }
    
    public function exibir(){
        $eventos = DB::table('evento')
                ->join('cidade', 'evento.cidade_id', '=', 'cidade.id')
                ->join('estado', 'cidade.estado_id', '=', 'estado.id')
                ->select('evento.id','nome','local','dataInicio','dataFim','descricao','imagem','empresa','email','telefone','cidade_id','nomeCidade','estado_id','nomeEstado','uf')
                ->get();
        $estados = Estado::all();
        return view('eventos::eventos', ['eventos' => $eventos,'estados' => $estados]);
    }
    
    public function cadastrar(Request $request)
    {
        $evento = new Evento();
        $evento->nome = $request->nome;
        $evento->local = $request->local;
        $evento->cidade_id = $request->cidade;
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
        try{
            $evento->update(['nome' => $request->nome,'local' => $request->local,'dataInicio' => $request->dataInicio, 'dataFim' => $request->dataFim, 'descricao' => $request->descricao, 'empresa' => $request->empresa, 'email' => $request->email, 'telefone' => $request->telefone]);
            $evento->cidade_id = $request->cidade;
            $evento->save();
            
            if ($request->hasFile('imgEvento')){
                $arquivo = $request->imgEvento;
                $extensao = $arquivo->getClientOriginalExtension();
                $nomeArquivo = time() . '.' . $extensao;
                $upload = $request->imgEvento->storeAs('eventos', $nomeArquivo);
                $evento->update(['imagem' => $nomeArquivo]);
            }
        
            return redirect()->route('eventos.exibir')
                ->with('success', $request->nome . ' alterado(a) com sucesso.');
        } catch (Exception $e){
            return redirect()->route('eventos.exibir')
                ->with('error', 'Falha ao atualizar evento "' . $request->agendaNome . '". Erro: ' . $e->getMessage());
        }
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
