@extends('ordemservico::layouts.informacoes')
@section('content')
<div class="card " style="margin:auto; max-width: 40rem;">
  <div class="card-header bg-info text-white">Soluções</div>
  <div class="card-body">
    <p class="card-text text-info">Problema </p>
    <p class="card-text text-secondary">Titulo : {{$data['problema']->titulo}}</p>
    @if($data['model']->count() == 0)
        <p class='text-secondary'> Nenhuma Solução Registrada </p>
    @else
    @foreach($data['model'] as $solucao)
    <p class="card-text text-secondary"> Solução: {{$solucao->descricao}}</p>
    @endforeach
    @endif
    <hr>

@endsection