@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Movimentação de Estoque')
@section('body')

<table class="table text-center ">

    <thead class="">
        
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movimentacao as $m)
            @if($m->quantidade > 0)
            <tr class="text-success">
                <td >{{$m->id}}</td>
                <td>{{$m->estoque->produtos->last()->nome}} - {{$m->estoque->tipoUnidade->nome}}({{$m->estoque->tipoUnidade->quantidade_itens}} itens)</td>
                <td>+{{$m->quantidade}}</td>
            </tr>
            @else
            <tr class="text-danger">
                <td>{{$m->id}}</td>
                <td>{{$m->estoque->produtos->last()->nome}} - {{$m->estoque->tipoUnidade->nome}}({{$m->estoque->tipoUnidade->quantidade_itens}} itens)  </td>
                <td>{{$m->quantidade}}</td>
            </tr>
            @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="100%" class="text-center">
                <p class="text-cetner">
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="100%" class="text-center">
            </td>
        </tr>
    </tfoot>
</table>
@endsection