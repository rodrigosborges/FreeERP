@extends('cliente::template')
@section('title','Cadastro de Pedidos')

@section('body')

<div id="nome_cliente" class="row d-flex border">
    Nome cliente
</div>

<div id="opcoes" class="row d-flex border justify-content-around">
    <button class="btn btn-primary">Adicionar Compra</button>
    <button class="btn btn-danger">Excluir</button>
    <button class="btn btn-warning">Editar</button>
</div>
<div id="table" class="border">
    <table class="table table bordered">
        <thead>
            <th>
                <th scope="col">Num Pedido</th>
                <th scope="col">Data</th>
                <th scope="col">Valor</th>
                <th scope="col">Desconto</th>
                <th scope="col">Ver Mais</th>
            </th>
        </thead>
        <tbody>
            <tr>
            <th scope="row">1</th>
            <td> Teste</td>
            <td> Teste</td>
            <td> Teste</td>
            <td> Teste</td>
            <td> <button class="btn btn-primary"><i class="material-icons">
                    add</i>
                    </td>

            </tr>
        </tbody>
    </table>
</div>

@endsection

