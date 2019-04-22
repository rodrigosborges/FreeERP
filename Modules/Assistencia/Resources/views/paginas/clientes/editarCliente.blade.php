@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')
<div class="container">
  <div class="row">
    <form class="" action="{{route('cliente.atualizar',$cliente->id)}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="hidden" name="_method" value="put">
      @include('assistencia::paginas.clientes._form')
      <button class="btn btn-success">Atualizar</button>
    </form>
  </div>
</div>

@stop
