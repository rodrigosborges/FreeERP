@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')
<div class="container">
  <div class="row">
    <form class="" action="{{route('cliente.salvar')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @include('assistencia::paginas.clientes._form')
      <button class="btn btn-success">Cadastrar</button>
    </form>
  </div>
</div>

@stop
