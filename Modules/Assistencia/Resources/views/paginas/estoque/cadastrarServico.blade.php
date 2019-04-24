@extends('assistencia::layouts.master')


@section('css')


@stop

@section('content')
<div class="container">
  <a href="{{route('estoque.index')}}"<i class="material-icons mr-2">arrow_back</i></button></a>
  <div class="row">
    <form class="" action="{{route('servicos.salvar')}}" method="post" enctype="multipart/form-data">
      {{ csrf_field() }}
      @include('assistencia::paginas.estoque._form_serv')
      <button class="btn btn-success">Cadastrar serviço padrão</button>
    </form>
  </div>
</div>

@stop
