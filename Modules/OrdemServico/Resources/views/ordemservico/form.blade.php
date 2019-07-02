@extends('ordemservico::layouts.informacoes')
@section('content')


<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">{{$data['title']}}</div>
    <div class="card-body">

        {{ Form::open(array('url' => $data['url'] , 'method'=>'post')) }}
        {{Form::token()}}
        @if($data['model'])
        @method('PUT')
        @else

        <div class="form-group">
            <div class="form-row">
                {{Form::label('Solicitante')}}
                {{Form::text('solicitante_id','',array('class' => 'form-control','placeholder'=>'Solicitante'))}}
            </div>
        </div>
        @endif

        <div class="form-row">
            <div class="col-md-4 mb-3">
                {{Form::label('Tipo do Aparelho')}}
                {{Form::text('tipo_aparelho', $data['model'] ? $data['model']->tipo_aparelho : old('tipo_aparelho'),array('class' => 'form-control','placeholder'=>'ex: computador'))}}
            </div>

            <div class="col-md-4 mb-3">
                {{Form::label('Marca')}}
                {{Form::text('marca', $data['model'] ? $data['model']->marca : old('marca'),array('class' => 'form-control','placeholder'=>'ex: dell'))}}
            </div>

            <div class="col-md-4 mb-3">
                {{Form::label('Número de Série')}}
                {{Form::text('numero_serie', $data['model'] ? $data['model']->numero_serie : old('numero_serie'),array('class' => 'form-control','placeholder'=>'Número de Série'))}}
            </div>
        </div>

        <div class="form-group">
            {{Form::textarea('descricao_problema', $data['model'] ? $data['model']->descricao_problema : old('descricao_problema'),array('class' => 'form-control','placeholder'=>'Descrição Problema'))}}
        </div>

        <div class="form-group">
            {{Form::submit( $data['button'],array('class'=>"btn btn-success") )}}
            <a href="{{ url('ordemservico/os') }}" class="btn btn-primary">Voltar</a>
        </div>
        {{ Form::close() }}
    </div>
</div>
@endsection