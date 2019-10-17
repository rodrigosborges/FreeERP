<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
    </style>
</head>
<body>

    <h4 style="font-size:30px; text-align: center;">Relatório de Custo</h4>

    Data inicial: {{date('d/m/y', strtotime($data['data_inicial']))}} - 
    Data final: {{date('d/m/y', strtotime($data['data_final']))}}<br>
    Preço de custo médio: R$ {{$data['custo_medio']}}<br>
    Quantidade total movimentada: {{$data['quantidade_movimentada'] ?? ''}} unidades<br>
    Custo total no período: R$ {{$data['custo_total']}}<br>
    Dia com maior custo: R$ <br>
    Dia com menor custo: R$ <br>
    Maior preço unitário: R$ {{$data['maior_custo']}}<br>
    <br>
    <table>
    <tr>
        <th>#</th>
        <th>Data</th>
        <th>Quantidade</th>
        <th>Preço unitário</th>
        <th>Custo total</th>
    </tr>
    @foreach($data['movimentacao'] as $movim)
    <tr>
        <td>{{$movim->id}}</td>
        <td>{{$movim->created_at}}</td>
        <td>{{$movim->quantidade}}</td>
        <td>{{$movim->preco_custo}}</td>
        <td>{{$movim->preco_custo*$movim->quantidade}}</td>
    </tr>
    @endforeach
    </table>
</body>
</html>

