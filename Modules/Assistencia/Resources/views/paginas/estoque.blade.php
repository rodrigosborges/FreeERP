@extends('assistencia::layouts.master')


@section('title', 'Assistencia')

@section('content')

  <div class="container">
    <div class="center-block" style="width:200px">
      <a href="{{route('pecas.localizar')}}"><button type="button" class="btn btn-info" name="button">Peças</button></a>
      <a href="{{route('servicos.localizar')}}"><button type="button" class="btn btn-info" name="button">Mão de Obra</button></a>


    </div>
  </div>


@stop
