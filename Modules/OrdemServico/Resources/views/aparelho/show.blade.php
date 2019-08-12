@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="card " style="margin:auto; max-width: 40rem;">
  <div class="card-header bg-dark text-white">ID : {{ $data['model']->id}} </div>
  <div class="card-body">
    <p class="card-text">Marca : {{$data['model']->marca}}</p>
    <p class="card-text">Tipo de aparelho : {{$data['model']->tipo_aparelho}}</p>
    <a href="{{ url('ordemservico/os') }}" class="btn btn-primary">Voltar</a>
  </div>
</div>
@endsection