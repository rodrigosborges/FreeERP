@extends('ordemservico::layouts.form')

@section('formulario')

@if(isset($data['model']))
{{ Form::model($data['model'], array('route' => array('modulo.os.update', $data['model']->id), 'method' => 'put')) }}
@endif

@if(!isset($data['model']))
@if($errors->count() > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p>{{$errors->first('solicitante.id')}}</p>
    <p>{{$errors->first('solicitante.nome')}}</p>
    <p>{{$errors->first('solicitante.email')}}</p>
    <p>{{$errors->first('telefone')}}</p>
    <p>{{$errors->first('endereco.cep')}}</p>
    <p>{{$errors->first('endereco.rua')}}</p>
    <p>{{$errors->first('endereco.numero')}}</p>
    <p>{{$errors->first('endereco.bairro')}}</p>
    <p>{{$errors->first('aparelho.numero_serie')}}</p>
    <p>{{$errors->first('aparelho.marca')}}</p>
    <p>{{$errors->first('aparelho.modelo')}}</p>
    <p>{{$errors->first('problema.titulo')}}</p>
    <p>{{$errors->first('descricao')}}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@include('ordemservico::ordemservico.formulario.solicitante')
@include('ordemservico::ordemservico.formulario.endereco')
@include('ordemservico::ordemservico.formulario.contato')
<hr>
@endif
@include('ordemservico::ordemservico.formulario.aparelho')
<hr>
@include('ordemservico::ordemservico.formulario.problema')

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.12/jquery.mask.min.js"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/tipocampos.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/solicitante.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/aparelho.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/contato.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/problema.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/acessorios.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/endereco.js')}}"></script>
@endsection