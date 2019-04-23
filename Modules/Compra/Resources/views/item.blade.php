@extends('template')
@section('content')
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantidade</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['item_compra'] as $item)
                    <tr>
                        <td>{{$item->nome_produto}}</td>
                        <td>{{$item->quantidade}}</td>
                        <td>
                            <form action="{{url('compra/itemCompra', [$item->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("compra/itemCompra/$item->id/edit") }}'>Editar</a> 
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                                <br>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <a class="btn btn-success" href="{{ url('compra/itemCompra/create') }}">Novo Item</a>
@endsection