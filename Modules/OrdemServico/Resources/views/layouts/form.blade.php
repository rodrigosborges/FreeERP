@extends('ordemservico::layouts.informacoes')
@section('content')

<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">{{$data['title']}}</div>
    <div class="card-body">
  
    {{ Form::open(array('url' => $data['url'] , 'method'=>'post')) }}
        {{Form::token()}}


        @yield('formulario')

        <div class="form-group">
            {{Form::submit( $data['button'],array('class'=>"btn btn-success") )}}
            <a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
        </div>
        {{ Form::close() }}
    </div>
</div>

    @yield('modal')

@endsection