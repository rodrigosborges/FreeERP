@extends('estoque::estoque.estoqueTemplate')
@section('title', 'Notificações de estoque baixo')
@section('body')

<table class="table text-center ">


    <thead class="">
        
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade Minima</th>
            <th scope="col">Quantidade Atual</th>
            <th scope="col">Detalhes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $item)
            <tr>
                <td >{{$item->id}}</td>
                <td>{{$item->produtos->last()->nome}}</td>
                <td>{{$item->quantidade_notificacao}}</td>
                <td class="text-danger">{{$item->quantidade}}</td>
                <td><a href="{{url('/estoque/movimentacao/alterar/' . $item->id)}}"><button class="btn btn-sm" style="font-size:0px; background-color: rgb(100,149,237);"><i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="100%" class="text-center">
                <p class="text-cetner">
                    Página {{$itens->currentPage()}} de {{$itens->lastPage()}}
                    -Exibido {{$itens->perPage()}} registro(s) por página de {{$itens->total()}}
                </p>
            </td>
        </tr>
        @if($itens->lastPage() > 1)
        <tr>
            <td colspan="100%" class="text-center">
                {{ $itens->links() }}
            </td>
        </tr>
        @endif
    </tfoot>
</table>
@endsection