@extends('assistencia::layouts.master')

@section('css')

@stop

@section('content')

<div class="container text-center">
  <div class="card-body">
    <div class="row text-left">
      <div class="col">
          <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <a href="{{route('cliente.localizar')}}"><button type="button" class="btn btn-info" name="button">Localizar</button></a>
      </div>
      <div class="col">
        <a href="{{route('cliente.cadastrar')}}"><button type="button" class="btn btn-info" name="button">Cadastrar</button></a>
      </div>

    </div>
  </div>
</div>


@stop
