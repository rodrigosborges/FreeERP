<?php
namespace Modules\Eventos\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Eventos\Entities\Evento;
use Modules\Eventos\Entities\Pessoa;
use Illuminate\Support\Facades\DB;
class PessoasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $eventos = Evento::orderBy('nome')->get(); //RETORNA OS EVENTOS ORDENADOS PELO NOME
        return view('eventos::pessoas', ['eventos' => $eventos, 'evento' => null]);
    }
    
    function exibir(Request $request)
    {
        $eventoId = $request->evento;
        $evento = Evento::find($eventoId);
        return view('eventos::pessoas', ['evento' => $evento, 'eventos' => []]);
    }
    
    function cadastrar(Request $request)
    {
        $pessoa = new Pessoa();
        $pessoa->nome = $request->nome;
        $pessoa->email = $request->email;
        $pessoa->telefone = $request->telefone;
        $pessoa->save();
        $pessoa->eventos()->attach($request->eventoId);
        
        return redirect()->route('pessoas.exibir', ['evento' => $request->eventoId])
            ->with('success', $request->nome . ' adicionado(a) com sucesso.');
    }
    
    public function editar(Request $request)
    {
        $pessoa = Pessoa::find($request->id);
        $pessoa->update(['nome' => $request-> nome, 'email' => $request->email, 'telefone' => $request->telefone]);
        return redirect()->route('pessoas.exibir', ['evento' => $request->eventoId])
            ->with('success', $request->nome . ' alterado(a) com sucesso.');
    }
    
    /* 
    * A função excluir não exclui a pessoa de fato, pois ela pode participar de mais de um evento,
    * e sim o relacionamento na tabela pivot que relaciona a pessoa ao evento
    */
    public function excluir(Request $request)
    {
        $pessoa = Pessoa::find($request->id);
        $pessoa->eventos()->detach($request->eventoId);
        return redirect()->route('pessoas.exibir', ['evento' => $request->eventoId])
            ->with('success', $pessoa->nome . ' excluído(a) com sucesso.');
    }
    
    //FUNÇÃO AINDA NÃO UTILIZADA PARA VERIFICAR NO FORM DO MODAL SE O E-MAIL JÁ FOI CADASTRADO
    public function verificaEmail(Email $email) //ARRUMAR
    {
        $resultado = DB::table('pessoa')
            ->select('pessoa.id')
            ->where('pessoa.email', $email)
            -get();
        return Response::json($resultado);
    }
}