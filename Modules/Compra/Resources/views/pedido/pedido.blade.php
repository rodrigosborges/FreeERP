@extends('template')
@section('content')
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['pedido'] as $p)
                    <tr>
                        <td>{{$p->id}}</td>
                        <td>{{$p->status}}</td>
                        <td>
                            <form action="{{url('compra/pedido', [$p->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("compra/pedido/$p->id/edit") }}'>Editar</a>
                                <a class="btn btn-info" href='{{ url("compra/pedido/$p->id/solicitarOrcamento") }}'>Solicitar Orçamento</a>  
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <a class="btn btn-success" href="{{ url('compra/pedido/create') }}">Novo Pedido</a>
@endsection