@extends('funcionario::template')

@section('title','Férias')

@section('body')
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Periodo Inicio</th>
      <th scope="col">Periodo Fim</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data['ferias'] as $ferias)
    <tr>
      <td> {{ $ferias->id }} </td>
      <td> {{ $ferias->data_inicio }} </td>
      <td> {{ $ferias->data_fim }} </td>
    </tr>
    @endforeach
  </tbody>
</table>
 
@endsection

@section('script')


@endsection