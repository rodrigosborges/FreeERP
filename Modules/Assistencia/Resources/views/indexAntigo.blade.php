@extends('assistencia::layouts.master')

@section('title', 'Assistencia')


@section('css')
  <style media="screen">
  .module-assistencia {
    border-radius: 5px;
    background-color: rgba(205,214,213,0.5);
    margin-right: 15px;
    width: 100%;
    height: 100%;
    display:flex;
    align-items: center;
  }
  .menu {
    flex-direction: row;
    margin: 10px;
    width: 100%;
    display:flex;
    justify-content: space-around;
    align-items: center;
  }
  .menu img {
    padding: 7px;
    background-color: rgba(123,155,166,0.5);
    border-radius: 5px;
  }

  </style>
@stop

@section('content')

  <div class="module-assistencia">
    <div class="menu">
      <a href="{{route('concertos.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/concerto.png') }}"></a>

      <a href="{{route('estoque.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/estoque.png') }}"></a>

      <a href="{{route('pagamento.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/pagamento.png') }}"></a>

      <a href="{{route('cliente.index')}}"><img width="100px" src="{{ Module::asset('assistencia:img-assistencia/cliente.png') }}"></a>
    </div>


  </div>




@stop
