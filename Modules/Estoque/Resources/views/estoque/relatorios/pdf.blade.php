<?php
use Illuminate\Support\Carbon;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
    <style>
        table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
        }

        td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        }

        tr:nth-child(even) {
        background-color: #dddddd;
        }

        body {
            margin-bottom: 20px;
        }

        footer {
        position: fixed; 
        bottom: 20px; 
        left: 0px; 
        right: 0px;
        height: 50px; 
        text-align: center;
        line-height: 35px;
        }

        h4 {
            font-size:30px;
            text-align: center;
        }

        .data {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h4>Relatório de Custo</h4>
    <div class="data">Data inicial: {{date('d/m/y', strtotime($data['data_inicial']))}} - 
    Data final: {{date('d/m/y', strtotime($data['data_final']))}}<br>
    <hr></div>
    <h5>Valores</h5>
    Preço de custo médio: R$ {{$data['custo_medio']}}<br>
    Quantidade total movimentada: {{$data['quantidade_movimentada'] ?? ''}} unidades<br>
    Custo total no período: R$ {{$data['custo_total']}}<br>
    <hr>
    <h5>Preços de Custo</h5>
    Dia com maior custo: {{$data['dia_maior_custo']}}<br>
    Dia com menor custo: {{$data['dia_menor_custo']}}<br>
    <hr>
    <h5>Preços unitários</h5>
    Maior preço unitário: R$ {{$data['maior_custo']}}<br>
    Menor preço unitário: R$ {{$data['menor_custo']}}<br>
    <hr>
    <br>
    <table>
    <tr>
        <th>#</th>
        <th>Data e Hora</th>
        <th>Quantidade</th>
        <th>Preço unitário</th>
        <th>Custo total</th>
    </tr>
    @foreach($data['movimentacao'] as $movim)
    <tr>
        <td>{{$movim->id}}</td>
        <td>{{date('d/m/y H:m:s', strtotime($movim->created_at))}}</td>
        <td>{{$movim->quantidade}}</td>
        <td>{{$movim->preco_custo}}</td>
        <td>{{$movim->preco_custo*$movim->quantidade}}</td>
    </tr>
    @if($movim == $data['movimentacao'][count($data['movimentacao'])-1])
        <footer>
            <p>Relatório emitido por FreeERP®</p>
            <p>Data: {{date('d/m/y H:i:s')}}</p>
        </footer>
    @endif
    @endforeach
    </table>
    
</body>

</html>

