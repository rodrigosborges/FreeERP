@extends('template')
@section('content')
<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-pills card-header-pills">
      <li class="nav-item">
        <a class="nav-link active" href="#">ID : {{ $data['model']->id}}</a>
      </li>
    </ul>
  </div>
  <div class="card-body">
    <p class="card-text">Solicitante : {{$data['model']->solicitante_id}}</p>
    <p class="card-text">Marca : {{$data['model']->marca}}</p>
    <p class="card-text">Tipo de aparelho : {{$data['model']->tipo_aparelho}}</p>
    <p class="card-text">Número de série : {{$data['model']->numero_serie}}</p>
    <p class="card-text">Descrição do problema : {{$data['model']->descricao_problema}}</p>
    <a href="{{ url('ordemservico/os') }}" class="btn btn-primary">Voltar</a>
     
  </div>
</div>
@endsection