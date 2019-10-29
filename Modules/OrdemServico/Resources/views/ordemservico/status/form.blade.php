@extends('ordemservico::layouts.form')

@section('formulario')

{{ Form::open( array('route' => array('modulo.status.store'), 'method' => 'post')) }}
{{Form::token()}}
{{Form::label("titulo",'Status: ')}}

{{Form::text("titulo",$value=null,array('class' => 'mb-3 form-control'))}}

@endsection