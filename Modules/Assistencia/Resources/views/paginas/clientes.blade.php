@extends('assistencia::layouts.master')

@section('title', 'Assistencia')
@section('css')
  <style media="screen">
    .module-assistencia {
        border-radius: 5px;
        background-color: rgba(123,155,166,0.5);
        margin-right: 15px;
        width: 100%;
        height: 100%;
        display:flex;
        flex-direction:
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
        background-color: rgba(65,91,118,0.5);
        border-radius: 5px;
      }
  </style>
@stop

@section('content')
  <div class="module-assistencia">

      <a href="{{url('/assistencia')}}"<i class="material-icons mr-2">arrow_back</i></button></a>

      <div class="conteudo">
        <a href="{{route('cliente.cadastrar')}}"><img src="{{ Module::asset('assistencia:img-assistencia/clientes/cadastrarCliente.png') }}" alt="Cadastrar cliente"></a>

        <a href="{{route('cliente.localizar')}}"><img src="{{ Module::asset('assistencia:img-assistencia/clientes/.png') }}" alt="Localizar cliente"></a>

      </div>



  </div>




@stop
