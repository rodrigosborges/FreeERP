<?php

namespace Modules\ContaAPagar\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContaAPagar\Entities\PagamentoModel;
use Modules\ContaAPagar\Entities\ContaAPagarModel;
    
class ContaAPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
     public function index(){

            $pagamentos = PagamentoModel::all();
            $contas = ContaAPagarModel::all();
             return view('contaapagar::index',compact('pagamentos', 'contas'));
      }


    public function list(){
        
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('contaapagar::create');
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
        return view('contaapagar::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('contaapagar::edit');
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
