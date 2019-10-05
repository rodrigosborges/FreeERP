<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatorio de compras - {{ $cliente->nome}}</title>
    <style>
        *{
            padding: 0;
            text-align: center;
            box-sizing: border-box;
        }
        table{
            border: 1px solid black;
            border-collapse: collapse;
        }
        #info tr td{
            height: 35px;
            padding-bottom: 5px;
            text-transform: capitalize;
        }
        #dados_pedido {
            background-color: #D3D3D3;
        }
        span{
            font-weight: bolder;
        }
        caption{
            font-size: 28px;
        }
        
    </style>
</head>
<body>
    <div>
        <table id="info" style="width: 100%">
            <caption> - Relatório de Compras - </caption>
            <tr>
                <td> 
                    <span>Cliente: </span> {{ $cliente->nome }}
                </td> 
                <td>
                    <span>Período Selecionado: </span>{{ $start->format('d/m/Y') }} - {{ $end->format('d/m/Y') }}
                </td>
                <td>
                    <span>Compras no Periodo: </span> {{ count($pedidos) }}
                </td>
                <td>
                    <span>Itens comprados: </span> {{$data["total_itens"]}}
                </td>
            </tr>

            <tr>
                <td>
                    <span>VL Bruto Total: </span> {{"R$ ".number_format($data["vl_bruto"], 2, ',', '.')}}
                </td>
                <td>
                    <span>VL Liquido Total: </span>
                            {{"R$ ".number_format($data["vl_liquido_total"], 2, ',', '.')}}
                </td>
                <td>
                    <span>Media Desconto Unidade: </span>{{number_format($data["media_desc_item"], 3, '.', '.')." %"}}
                </td>
                <td>
                    <span>Media Desconto Pedidos: </span>{{number_format($data["media_desc_pedido"], 3, '.', '.')." %"}}
                </td>
            </tr>
            
        </table>

        @foreach ($pedidos as $pedido)
            <div style="width: 100%; ">

                <table style="width:100%">
                    <tr id="dados_pedido">
                        <td><span>Num. Pedido:</span> {{$pedido->numero}}</td>
                        <td><span>Dt Pedido: </span>{{$pedido->data}}</td>
                        <td ><span>Desc. Pedido: </span>{{$pedido->desconto}} %</td>
                        <td style="text-align: center">
                            <span>Vl Liquido: </span>{{ "R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}
                        </td>
                    <td><span>Itens: </span>{{count($pedido->produtos)}}</td>

                    </tr>
                    <tr>
                        <th>Item</th>
                        <th>Qtde</th>
                        <th>R$ UN</th>
                        <th>Desconto</th>
                        <th>Vl Liquido</th>
                    </tr>
                    @forelse ($pedido->vl_total_itens() as $item)
                    <tr>
                        <td>{{$item->nome}}</td>
                        <td>{{$item->quantidade}}</td>
                        <td>{{ "R$ ".number_format($item->preco, 2, ',', '.') }}</td>
                        <td>{{ $item->desconto." %"}}</td>
                        <td>{{ "R$ ".number_format($item->valor_total, 2, ',', '.')}}</td>
                    </tr>    
                    @empty
                        
                    @endforelse
                    

                </table>
                <hr />
            </div>
        @endforeach        
    
    
    
    
    
    </div>
</body>
<script>
    
</script>
</html>