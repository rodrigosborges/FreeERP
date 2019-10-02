<?php

namespace Modules\Eventos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Eventos\Entities\Evento;
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
        $eventoId = null;
        return view('eventos::pessoas', ['eventos' => $eventos, 'eventoId' => $eventoId]);
    }
    
    function exibir(Request $request)
    {
        $eventoId = $request->input('eventoSelecionado');
        $eventoNome = DB::table('evento')
            ->select('evento.nome')
            ->where('id', $eventoId)
            ->first();
        //dd($eventoNome);
        //VARIÁVEL QUE ARMAZENA TODAS AS PESSOAS PARTICIPANTES DO EVENTO SELECIONADO
        $evento_pessoas = DB::table('pessoa')
            ->join('evento_has_pessoa', 'evento_has_pessoa.pessoa_id', 'pessoa.id')
            ->select('pessoa.*', 'evento_has_pessoa.evento_id')
            ->where('evento_has_pessoa.evento_id', $eventoId)
            ->get(); 
        return view('eventos::pessoas', ['eventoId' => $eventoId, 'eventoNome' => $eventoNome, 'evento_pessoas' => $evento_pessoas]);
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
