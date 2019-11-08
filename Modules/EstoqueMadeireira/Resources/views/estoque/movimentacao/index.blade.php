@extends('estoquemadeireira::estoque.template')
@section('title', 'Movimentação de Estoque')
@section('body')

<table class="table text-center ">

<h5>Pesquisar Movimentação</h5>
                <form method="POST" action="{{url('/estoquemadeireira/movimentacao/buscar')}}" id="form">
                    @csrf
                    <div class="row mb-3 mt-3">
                        <div class="form-group col-11">
                            <input id="search-input" placeholder="Insira o ID da movimentação ou a quantidade" maxlength="45" class="form-control" type="text" name="pesquisa" />
                        </div>
                        <div class="form-group col-1">
                            <button type="submit" class="btn btn-sm btn-secondary" style="font-size:18px;"><i class="btn btn-sm btn-secondary material-icons" style="font-size:18px;" id="search-button">search</i></button>
                        </div>
                    </div>
                        
                    </div>
                </form>


    <thead class="">
        
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Produto</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Data</th>
            <th scope="col">Detalhes</th>
        </tr>
    </thead>
    <tbody>
        @foreach($movimentacao as $m)
            @if($m->quantidade > 0)
            <tr>
                <td >{{$m->id}}</td>
                <td>{{$m->estoque->produtos->last()->nome}} - {{$m->estoque->tipoUnidade->nome}} {{$m->estoque->tipoUnidade->quantidade_itens}}</td>
                <td class="text-success">+{{$m->quantidade}}</td>
                <td>{{$m->created_at}}</td>
                <td><a href="{{url('/estoque/movimentacao/' . $m->id)}}"><button class="btn btn-sm" style="font-size:0px; background-color: rgb(100,149,237);"><i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a></td>
            </tr>
            @else
            <tr>
                <td>{{$m->id}}</td>
                <td>{{$m->estoque->produtos->last()->nome}} - {{$m->estoque->tipoUnidade->nome}}({{$m->estoque->tipoUnidade->quantidade_itens}} itens)  </td>
                <td class="text-danger">{{$m->quantidade}}</td>
                <td>{{$m->created_at}}</td>
                <td><a href="{{url('/estoque/movimentacao/' . $m->id)}}"><button class="btn btn-sm" style="font-size:0px; background-color: rgb(100,149,237);"><i class="material-icons" style="font-size:18px;">remove_red_eye</i></button></a></td>
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