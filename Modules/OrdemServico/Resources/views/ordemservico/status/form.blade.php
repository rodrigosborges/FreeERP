@extends('ordemservico::layouts.form')
@section('formulario')

@if($data['model'])
<div class="col-md-3 mb-1">
        {{Form::label("ordemservico[status]",'Status Atual: ')}}
        <div class="input-group">
            {{Form::select("status_id",$data['status'],$value = $data['model']->status_id ,array('class' => 'form-control'))}}
        </div>
    </div>
@else
{{Form::label('titulo','Titulo')}}
<div class='telefones'>
    <div class='form-inline'>
        <div class="form-group  mx-sm-3 mb-2">
            {{Form::text('titulo',$value=null,array('class' => 'form-control','placeholder'=>'Titulo'))}}
        </div>
    </div>
</div>
@endif
@endsection
