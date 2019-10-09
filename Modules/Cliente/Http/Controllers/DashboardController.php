<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('cliente::dashboard.index');
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('cliente::create');
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
        return view('cliente::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('cliente::edit');
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

    public function getVendasMes($ano)
    {
        $pedidos = Pedido::whereYear('data', '=', $ano)->get();

        $dados = [
            1 => "JAN", 2 => "FEV", 3 => "MAR", 4 => "ABR", 5 => "MAI", 6 => "JUN", 7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT",
            11 => "NOV", 12 => "DEZ"
        ];

        $vl_meses = [
            "JAN" => 0, "FEV" => 0, "MAR" => 0, "ABR" => 0, "MAI" => 0, "JUN" => 0, "JUL" => 0, "AGO" => 0,
            "SET" => 0, "OUT" => 0, "NOV" => 0, "DEZ" => 0
        ];

        if (count($pedidos) > 0) {
            foreach ($pedidos as $pedido) {
                $mes = DateTime::createFromFormat('d/m/Y', $pedido->data)->format('m');

                foreach ($dados as $key => $meses)
                    if ($mes == $key)
                        $vl_meses[$meses] += NUMBER_FORMAT($pedido->vl_total_pedido(), 2);
            }
        }
    }
}
