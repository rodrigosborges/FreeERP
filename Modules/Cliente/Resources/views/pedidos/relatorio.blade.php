<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatorio de compras - {{ $cliente->nome}}</title>
    <style>
        table{
            border: 1px solid black;
            border-collapse: collapse;
        }
        #dados_pedido {
            background-color: gray;
        }
        span{
            font-weight: bolder;
        }
        #info{
        }
    </style>
</head>
<body>
    <div>
        
        <table style="width: 100%">
            <caption>Relatorio de compras: {{ $cliente->nome}}</caption>
            <tr>
                <td style="text-align: center; border: 1px solid black">
                    <span>Período:</span>{{ $start->format('d/m/Y') }} - {{ $end->format('d/m/Y') }}
                </td>
                <td>
                    <span>Total de compras no periodo:</span> {{ count($pedidos) }}
                </td>
                <td><span>VL Liquido Total: </span>
                    {{$data["vl_total"]}}
                </td>
            <td><span>Media desconto Item: {{$data["media_desc_item"]}}</span> </td>
            </tr>
            
        </table>
       

        @foreach ($pedidos as $pedido)
            <div style="width: 100%; ">

                <table style="width:100%">
                    <tr id="dados_pedido">
                        <td><span>Num. Pedido:</span> {{$pedido->numero}}</td>
                        <td><span>Dt Pedido: </span>{{$pedido->data}}</td>
                        <td ><span>Desc. Pedido: </span>{{$pedido->desconto}} %</td>
                        <td colspan="2" style="text-align: center">
                            <span>Vl Liquido: </span>{{ "R$ ".number_format($pedido->vl_total_pedido(), 2, ',', '.') }}
                        </td>
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