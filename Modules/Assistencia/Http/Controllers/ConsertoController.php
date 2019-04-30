<?php

namespace Modules\Assistencia\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Assistencia\Entities\Conserto_assistencia;

class ConsertoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index()
     {

       return view('assistencia::paginas.conserto');
     }

     public function cadastrar(){
       /*ATENÇÃO, TALVEZ ESTE IF NÃO SEJA NECESSARIO, APÓS FINALIZAR O FORM, TESTAR SEM A PARTE DE CIMA*/
       $ordens = conserto::all();
       if ($ordens == null):
         $id = 1;
         return view('assistencia::paginas.consertos.cadastrarconserto');
       else:

         $id = conserto::max();
         $id = $id + 1;
         return view('assistencia::paginas.consertos.cadastrarconserto',compact('id'));
      endif;

     }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('assistencia::create');
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
        return view('assistencia::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('assistencia::edit');
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
