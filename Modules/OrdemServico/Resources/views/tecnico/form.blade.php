@extends('ordemservico::layouts.informacoes')
@section('content')

<div class="card " style="margin:auto; max-width: 40rem;">
    <div class="card-header text-white bg-dark">{{$data['title']}}</div>
    <div class="card-body">

        @if(isset($data['model']))
        {{ Form::model($data['model'], array('route' => array('modulo.tecnico.update', $data['model']->id), 'method' => 'put')) }}
        @endif
        {{ Form::open(array('url' => $data['url'] , 'method'=>'post')) }}
        {{Form::token()}}

        <div class="form-group">
            <div class="form-row">
                {{Form::label('Nome')}}
                {{Form::text('nome',$value=null,array('class' => 'form-control','placeholder'=>'Nome'))}}
            </div>
        </div>


        <div class="form-group">
            <button type="submit" class="btn btn-success"> {{ $data['button'] }} </button>
            <a href="{{ url('ordemservico/tecnico') }}" class="btn btn-primary">Voltar</a>
        </div>
    </div>

    </form>

</div>
@endsection