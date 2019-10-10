@extends('ordemservico::layouts.form')
@section('formulario')

@if(isset($data['model']))
{{ Form::model($data['model'], array('route' => array('modulo.os.update', $data['model']->id), 'method' => 'put')) }}
@endif

@if(!isset($data['model']))

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
<script src="{{Module::asset('ordemservico:js/ordemservico/aparelho.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/contato.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/problema.js')}}"></script>
<script src="{{Module::asset('ordemservico:js/ordemservico/acessorios.js')}}"></script>
@endsection