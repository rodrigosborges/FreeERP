@extends('funcionario::template')

@section('title')
    {{ $data['title'] }}
@endsection

@section('body')
    <table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">CID</th>
      <th scope="col">Data de Inicio</th>
      <th scope="col">Data de Fim</th>
      <th scope="col">Situação</th>
      <!-- <th scope="col">Açôes</th> -->
    </tr>
  </thead>
  <tbody>
    @foreach($data['atestado'] as $atestado)
    <tr>
      <td> {{ $atestado->id}} </td>
      <td> {{$atestado->cid_atestado}} </td>
      <td> {{ $atestado->data_inicio }} </td>
      <td> {{ $atestado->data_fim }} </td>
      <td> {{$atestado->situacao}} </td>
      <td class="min">                  
    </tr>
    @endforeach
    
  </tbody>
</table>
@section('footer')
    <div class="d-flex justify-content-end">
    <a class="btn btn-success" href="{{url('funcionario/funcionario')}}">Voltar</a>
    </div>

@endsection

@endsection