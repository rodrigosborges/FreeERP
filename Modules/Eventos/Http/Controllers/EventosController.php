<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Eventos\Entities\Evento;
use Modules\Eventos\Entities\Estado;
use Modules\Eventos\Entities\Permissao;
use Modules\Eventos\Entities\Programacao;
use Modules\Eventos\Entities\Nivel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Modules\Eventos\Entities\Pessoa;
use Carbon\Carbon;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
       
    //EXIBE AS VIEWS
    public function index(){
        $data = new Carbon();
        $data->format('Y-m-d');
        $eventos = Evento::orderBy('dataInicio', 'ASC')->where('dataInicio', '>=', $data)->get();
        $estados = Estado::all();
        return view('eventos::index', ['eventos' => $eventos,'estados' => $estados]);
    }
    
    public function exibir(){
        $eventos = Evento::whereHas('permissoes', function (Builder $query){
            $query->where('nivel_id', '=', 3)->orWhere('nivel_id', '=', 2);
        })->get();
        $estados = Estado::all();
        $pessoas = Pessoa::all();
        return view('eventos::eventos', ['eventos' => $eventos,'estados' => $estados, 'pessoas' => $pessoas]);
    }
    
    public function cadastrar(Request $request)
    {
        try{
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
            
            $permissao = new Permissao();
            $permissao->evento()->associate($evento);
            $permissao->nivel()->associate(Nivel::find(3));
            $permissao->pessoa()->associate(Auth::user());
            
            $permissao->save();
            
            $organizadores = $request->organizador;
            if($organizadores != null){
                foreach ($organizadores as $pessoa_id){
                    $permissao = new Permissao();
                    $permissao->evento()->associate($evento);
                    $permissao->nivel()->associate(Nivel::find(2));
                    $permissao->pessoa()->associate($pessoa_id);
                    $permissao->save();
                }
            }            
        } catch (\Exception $e){
            return redirect()->route('eventos.exibir')
                ->with('error', 'Falha ao adicionar evento: ' . $e->getMessage());
        }
        return redirect()->route('eventos.exibir')
                ->with('success', $request->nome . ' adicionado(a) com sucesso.');
        
    }
    
    public function editar(Request $request)
    {
        try{
            $evento = Evento::find($request->id);
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
        } catch (\Exception $e){
            return redirect()->route('eventos.exibir')
                ->with('error', 'Falha ao atualizar evento ' . $request->nome . ': ' . $e->getMessage());
        }
        return redirect()->route('eventos.exibir')
            ->with('success', $request->nome . ' alterado(a) com sucesso.');
    }
    
    public function excluir(Request $request)
    {
        try{
            $evento = Evento::find($request->id);
            $evento->pessoas()->detach();
            $evento->delete();
        } catch (\Exception $e){
            return redirect()->route('eventos.exibir')
                ->with('error', 'Falha ao excluir ' . $evento->nome . ': ' . $e->getMessage());
        }
        
        return redirect()->route('eventos.exibir')
            ->with('success', $evento->nome . ' excluído(a) com sucesso.');
    }
    
    public function detalhar($id){
        $evento = Evento::find($id);
        $programacao = $evento->programacao;
        return view('eventos::detalhaEvento', ['evento' => $evento, 'programacao' => $programacao]); 
    }
    
    public function inscricao(Programacao $programacao)
    {
        if($programacao->participantes()->where('pessoa_id', Auth::id())->first())
            $programacao->participantes()->detach(Auth::id());
        else
            $programacao->participantes()->attach(Auth::id());

        return redirect()->route('eventos.detalhar', ['evento' => $programacao->evento]);
    }
    
    public function inscricoes($id){
        return view('eventos::detalhaEvento', ['evento' => $evento, 'programacao' => $programacao]); 
    }
    
    public function getEvento($id){
        $evento = DB::table('evento')
                ->where('evento.id', '=', $id)
                ->join('cidade', 'evento.cidade_id', '=', 'cidade.id')
                ->join('estado', 'cidade.estado_id', '=', 'estado.id')
                ->select('evento.id','nome','local','dataInicio','dataFim','descricao','imagem','empresa','email','telefone','cidade_id','nomeCidade','estado_id','nomeEstado','uf')
                ->get();
        return $evento;
    }
    
    //RETORNA A DATA ATUAL
    public function getData(){
        $data = new Carbon();
        return $data->format('Y-m-d');
    }
}
