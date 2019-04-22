@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')
<div class="container">
  <div class="row">
    <form class="" action="{{route('pecas.salvar')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @include('assistencia::paginas.estoque._form_peca')
      <button class="btn btn-success">Cadastrar peça</button>
    </form>
  </div>
</div>

@stop
