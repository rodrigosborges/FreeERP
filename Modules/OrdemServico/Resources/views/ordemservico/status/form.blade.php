@extends('ordemservico::layouts.form')

@section('formulario')

@if($errors->count() > 0 )
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <p>{{$errors->first('titulo')}}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

{{ Form::open( array('route' => array('modulo.status.store'), 'method' => 'post')) }}
{{Form::token()}}
{{Form::label("titulo",'Status: ')}}

{{Form::text("titulo",$value=null,array('class' => 'mb-3 form-control'))}}

@endsection