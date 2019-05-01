@extends('assistencia::layouts.master')


@section('title', 'Assistencia')

@section('content')

<div class="container text-center">
  <div class="card-body">
    <div class="row text-left">
      <div class="col">
          <a href="{{url('/assistencia')}}"<i class="material-icons mr-2">home</i></button></a>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <a href="{{route('pecas.localizar')}}"><button type="button" class="btn btn-info" name="button">Peças</button></a>
      </div>
      <div class="col">
        <a href="{{route('servicos.localizar')}}"><button type="button" class="btn btn-info" name="button">Mão de Obra</button></a>
      </div>

    </div>
  </div>
</div>
@stop
