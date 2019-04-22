@extends('assistencia::layouts.master')

@section('title', 'Assistencia')


@section('css')

@stop

@section('content')

  <div class="content-body">
    <div class="row">
      <div class="col">
        <h3>Concertos</h3>
        <a href="{{route('concertos.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/concerto.png') }}"></a>

      </div>
      <div class="col">
        <h3>Estoque</h3>
        <a href="{{route('estoque.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/estoque.png') }}"></a>
      </div>
      <div class="col">
        <h3>Pagamentos</h3>
        <a href="{{route('pagamento.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/pagamento.png') }}"></a>
      </div>
      <div class="col">
        <h3>Clientes</h3>
        <a href="{{route('cliente.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/cliente.png') }}"></a>
      </div>
    </div>
    <div class="row match-height">
      <div class="col-x1-8 col-lg-12">
        grafico1
      </div>
      <div class="col-x1-8 col-lg-12">
        grafico2
      </div>
    </div>
  </div>




@stop
