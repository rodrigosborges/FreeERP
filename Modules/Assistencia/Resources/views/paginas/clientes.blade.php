@extends('assistencia::layouts.master')

@section('css')

@stop

@section('content')

<div class="container">
  <a href="{{url('/assistencia')}}"<i class="material-icons mr-2">arrow_back</i></button></a>
  <div class="center-block" style="width:200px">
    <a href="{{route('cliente.localizar')}}"><button type="button" class="btn btn-info" name="button">Localizar</button></a>
    <a href="{{route('cliente.cadastrar')}}"><button type="button" class="btn btn-info" name="button">Cadastrar</button></a>


  </div>
</div>



@stop
