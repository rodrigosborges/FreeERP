@extends('template')
@section('content')
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['pedido'] as $pedido)
                    <tr>
                        <td>{{$pedido->id}}</td>
                        <td>
                            <a class="btn btn-info" href='{{ url("compra/Orcamento/create") }}'>Enviar Orçamento</a> 
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection