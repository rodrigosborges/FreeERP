<?php

namespace Modules\Cliente\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Cliente\Entities\{Cliente, Pedido, Produto};
use DateTime;

class DashboardController extends Controller
{
    
    public function index()
    {
        return view('cliente::dashboard.index');
    }

    public function getTotalVendas($ano){
        return $pedidos = Pedido::whereYear('data', '=', $ano)->get()->count();

    }
    public function getTotalClientes($ano){
        // $pedidos = Pedido::whereYear('data', '=', $ano)->get();
        // $clientes = [];
        // foreach($pedidos as $pedido){
        //     array_push($clientes,$pedido->cliente);
        // }       
        // $clientes;
        // return collect($clientes)->groupBy('id')->count();
            return Cliente::join('pedido','pedido.cliente_id','=','cliente.id')->whereYear('pedido.data', '=' , $ano)->select('cliente.id')->groupBy('cliente.id')->get()->count();
            
    }



    public function getMediaGasto($ano){
        $pedidos = Pedido::whereYear('data', '=', $ano)->get();
        $vl_total_pedido = 0;
        if (count($pedidos) > 0) {
            foreach ($pedidos as $pedido) {
                $vl_total_pedido += NUMBER_FORMAT($pedido->vl_total_pedido(), 2);
            }
            return $vl_total_pedido/count($pedidos);
        }
        else{
            return 0;
        }
        
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

        if ( count($pedidos) > 0 ) {
            foreach ($pedidos as $pedido) {
                $mes = DateTime::createFromFormat('d/m/Y', $pedido->data)->format('m');

                foreach ($dados as $key => $meses)
                    if ($mes == $key)
                        $vl_meses[$meses] += NUMBER_FORMAT($pedido->vl_total_pedido(), 2);
            }
        }

        return $vl_meses;
    }


    public function getVendasProdutoMes($id_produto, $ano){
        $produto = Produto::findOrFail($id_produto);

        $pedidos = $produto->pedidos()->whereYear('data', '=', $ano)->get();
        $dados = [
            1 => "JAN", 2 => "FEV", 3 => "MAR", 4 => "ABR", 5 => "MAI", 6 => "JUN", 7 => "JUL", 8 => "AGO", 9 => "SET", 10 => "OUT",
            11 => "NOV", 12 => "DEZ"
        ];
        $qtde_mes = [
            "JAN" => 0, "FEV" => 0, "MAR" => 0, "ABR" => 0, "MAI" => 0, "JUN" => 0, "JUL" => 0, "AGO" => 0,
            "SET" => 0, "OUT" => 0, "NOV" => 0, "DEZ" => 0
        ];

        if ( count($pedidos) > 0 ) {

            foreach ( $pedidos as $pedido ) {
                $produto = $pedido->produto_qtde($id_produto);
                $mes = DateTime::createFromFormat('d/m/Y', $pedido->data)->format('m');
                
                foreach ($dados as $key => $meses)
                    if ($mes == $key)
                        $qtde_mes[$meses] += NUMBER_FORMAT($produto->qtde, 2);
            }
        }

        return $qtde_mes;

    }
}
