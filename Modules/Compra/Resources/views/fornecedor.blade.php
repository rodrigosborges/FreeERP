@extends('template')
@section('content')
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="ativos" role="tabpanel" aria-labelledby="ativos-tab">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nome do Fornecedor</th>
                        <th>E-mail do Fornecedor</th>
                        <th>Endereço de Fornecedor</th>
                        <th>Telefone</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($data['fornecedor'] as $fornecedor)
                    <tr>
                        <td>{{$fornecedor->nome_fornecedor}}</td>
                        <td>{{$fornecedor->email}}</td>
                        <td>{{$fornecedor->endereco}}</td>
                        <td>{{$fornecedor->telefone}}</td>
                        <td>
                            <form action="{{url('compra/fornecedor', [$fornecedor->id])}}" method="POST">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <a class="btn btn-warning" href='{{ url("compra/fornecedor/$fornecedor->id/edit") }}'>Editar</a> 
                                <input type="submit" class="btn btn-danger" value="Delete"/>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <a class="btn btn-success" href="{{ url('compra/fornecedor/create') }}">Novo Fornecedor</a>
@endsection