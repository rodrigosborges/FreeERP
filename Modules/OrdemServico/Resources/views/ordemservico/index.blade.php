@extends('template')
@section('content')

<form method="GET" action="#">
    <div class="form-row form-group">
        {!! Form::label('busca', 'Procurar por', ['class' => 'col-sm-2 col-form-label text-right']) !!}
        <div class="input-group col-sm-8">
            {!! Form::text('busca', isset($busca) ? $busca : null, ['class' => 'form-control']) !!}
          <div class="input-group-append">
            {!! Form::submit('Buscar', ['class'=>'btn btn-primary']) !!}
        </div>
    </div>
    </div>
</form>

<div class="text-center">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th>Solicitante</th>
                <th>Descrição</th>
                <th><a class="btn btn-success center-block" href="{{ url('ordemservico/os/create')  }}">Abrir OS</a></th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['ordem_servico'] as $os)
            <tr>
                <td>{{$os->solicitante_id}}</td>
                <td>{{$os->descricao_problema}}</td>
                <td>
                    <form action="{{url('ordemservico/os',[$os->id])}}" method="POST">
                        {{method_field('DELETE')}}
                        {{ csrf_field() }}
                        <a class="btn btn-outline-warning btn-sm" href='{{ url("ordemservico/os/$os->id/") }}'>Detalhes</a>
                        <a class="btn btn-outline-info btn-sm" href='{{ url("ordemservico/os/$os->id/edit") }}'>Editar</a>
                        <a class="btn btn-outline-dark btn-sm" href='{{ url("ordemservico/os/pdf")}}'>PDF</a>
                        <input type="submit" class="btn btn-outline-danger btn-sm" value="Delete" />
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row justify-content-center">
    {{ $data['ordem_servico']->links() }}
</div>
@endsection