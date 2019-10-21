@extends('funcionario::template')

@section('title','Férias')

@section('body')
<table class="table table-hover text-center">
  <thead class="thead-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Periodo Inicio</th>
      <th scope="col">Periodo Fim</th>
      <!-- <th scope="col">Açôes</th> -->
    </tr>
  </thead>
  <tbody>
    @foreach($data['ferias'] as $ferias)
    <tr>
      <td> {{ $ferias->id }} </td>
      <td> {{ \Carbon\Carbon::parse($ferias->data_inicio)->format('d/m/Y') }} </td>
      <td> {{ \Carbon\Carbon::parse($ferias->data_fim)->format('d/m/Y') }} </td>
      <td class="min">                  
        <!-- <a class="btn btn btn-success" href='{{url("funcionario/ferias/$ferias->id/show")}}'>Visualizar</a>     
        <a class="btn btn-warning" href='{{ url("funcionario/ferias/$ferias->id/edit") }}'>Editar</a> -->
    </tr>
    @endforeach
  </tbody>
</table>
@section('footer')
    <div class="text-right">
    <a class="btn btn-success" href="{{url('funcionario/ferias')}}">Voltar</a>
    </div>
@endsection
@endsection

@section('script')


@endsection