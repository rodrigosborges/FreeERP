<?php
namespace Modules\Eventos\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Eventos\Entities\Evento;
use Modules\Eventos\Entities\Pessoa;
use Modules\Eventos\Entities\Programacao;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PessoasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $eventos = Evento::whereHas('permissoes', function (Builder $query){
            $query->where('pessoa_id', '=', auth::id());
        })->get()->sortBy('nome');
        //VERIFICA SE EXISTE PELO MENOS 1 EVENTO CADASTRADO
        if(count($eventos) < 1)
            return view('eventos::cadastrarEvento');
        else    
            return view('eventos::pessoas', ['eventos' => $eventos, 'evento' => null]);
    }
    
    function exibir(Request $request)
    {
        $evento = Evento::find($request->evento);
        
        return view('eventos::pessoas', ['evento' => $evento, 'eventos' => []]);
    }
        
    /* 
    * A função excluir não exclui a pessoa de fato, pois ela pode participar de mais de um evento,
    * e sim o relacionamento na tabela pivot que relaciona a pessoa ao evento
    */
    public function excluir(Request $request)
    {
        try{
            $programacao = Programacao::find($request->AtividadeId);
            $programacao->participantes()->detach($request->id);
            $pessoa = Pessoa::find($request->id);
        } catch (\Exception $e) {
            return redirect()->route('pessoas.exibir', ['evento' => $programacao->evento_id])
                ->with('error', 'Falha ao excluir ' . $pessoa->nome . ': ' . $e->getMessage());
        }
        
        return redirect()->route('pessoas.exibir', ['evento' => $programacao->evento_id])
            ->with('success', $pessoa->nome . ' excluído(a) com sucesso.');
    }
    
     function meusCertificados()
    {        
        $pessoa = Pessoa::find(Auth::id());
        return view('eventos::meusCertificados', ['pessoa' => $pessoa]);
    }
}