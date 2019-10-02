@extends('funcionario::template')

@section('title','Férias')

@section('body')
<table class="table">
  <thead>
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
      <td> {{ $ferias->data_inicio }} </td>
      <td> {{ $ferias->data_fim }} </td>
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