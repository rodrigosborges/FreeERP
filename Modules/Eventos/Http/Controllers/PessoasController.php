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
        
        return redirect()->route('pessoas.exibir', ['evento' => $request->eventoId])->with('success', $request->nome . ' adicionado(a) com sucesso.');
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
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('eventos::create');
    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('eventos::show');
    }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('eventos::edit');
    }
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}