@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Movimentação de Estoque')
@section('body')

<table class="table text-center ">

    <thead class="">
        
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Detalhes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movimentacao as $m)
            @if($m->quantidade > 0)
            <tr class="text-success">
                <td >{{$m->id}}</td>
                <td>{{$m->estoque->produtos->last()->nome}} - {{$m->estoque->tipoUnidade->nome}}({{$m->estoque->tipoUnidade->quantidade_itens}} itens)</td>
                <td>+{{$m->quantidade}}</td>
                <td><a href="{{url('/estoque/movimentacao/' . $m->id)}}"><button class="btn btn-sm btn-primary"><i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a></td>
            </tr>
            @else
            <tr class="text-danger">
                <td>{{$m->id}}</td>
                <td>{{$m->estoque->produtos->last()->nome}} - {{$m->estoque->tipoUnidade->nome}}({{$m->estoque->tipoUnidade->quantidade_itens}} itens)  </td>
                <td>{{$m->quantidade}}</td>
                <td><a href="{{url('/estoque/movimentacao/' . $m->id)}}"><button class="btn btn-sm btn-primary"><i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a></td>
            </tr>
            @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="100%" class="text-center">
                <p class="text-cetner">
                    Página {{$movimentacao->currentPage()}} de {{$movimentacao->lastPage()}}
                    -Exibido {{$movimentacao->perPage()}} registro(s) por página de {{$movimentacao->total()}}
                </p>
            </td>
        </tr>
        @if($movimentacao->lastPage() > 1)
        <tr>
            <td colspan="100%" class="text-center">
                {{ $movimentacao->links() }}
            </td>
        </tr>
        @endif
    </tfoot>
</table>
@endsection