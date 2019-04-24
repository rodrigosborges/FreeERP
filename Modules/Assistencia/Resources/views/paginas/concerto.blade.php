@extends('assistencia::layouts.master')


@section('title', 'Assistencia')

@section('content')

<div class="container text-center">
  <div class="card-body">
    <div class="row text-left">
      <div class="col">
          <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <a href="{{route('concertos.cadastrar')}}"><button type="button" class="btn btn-info" name="button">Novo concerto</button></a>
      </div>
      <div class="col">
        <a href=""><button type="button" class="btn btn-info" name="button">Localizar concertos</button></a>
      </div>
      <div class="col">
        <a href=""><button type="button" class="btn btn-info" name="button">Finalizar concerto</button></a>
      </div>

    </div>
  </div>
</div>

@stop
