<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Eventos\Entities\Evento;
use Illuminate\Support\Facades\Storage;

class EventosController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
       
    //EXIBE AS VIEWS
    public function index(){
        $eventos = Evento::all();
        return view('eventos::index', ['eventos' => $eventos]);
    }
    
    public function exibir(){
        $eventos = Evento::all();
        return view('eventos::eventos', ['eventos' => $eventos]);
    }
    
    function cadastrar(Request $request)
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
    
    public function excluir(Request $request)
    {
        $evento = Evento::find($request->id);
        $pessoa->eventos()->detach($request->eventoId);
        return redirect()->route('pessoas.exibir', ['evento' => $request->eventoId])
            ->with('success', $pessoa->nome . ' excluído(a) com sucesso.');
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
    public function destroy(Evento $evento)
    {
        $evento->delete();
        return redirect()->route('eventos.exibir');
    }
}
