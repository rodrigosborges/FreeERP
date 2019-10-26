@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="card " style="margin:auto; max-width: 50rem;">
    <div class="card-header bg-info text-white">Acompanhar OS</div>
    <div class="card-body h-100">
    {{ Form::open(array('url' => route('modulo.os.linhaTempo') ,'class'=>'form-inline', 'method'=>'post')) }}
        {{Form::token()}}
        {{Form::text("protocolo",null,array('class'=>"form-control  mr-3 w-75",'placeholder'=>'Digite o protocolo'))}}
        {{Form::submit("Pesquisar",array('class'=>"btn  btn-success") )}}
   
        {{ Form::close() }}
    </div>
</div>
@endsection