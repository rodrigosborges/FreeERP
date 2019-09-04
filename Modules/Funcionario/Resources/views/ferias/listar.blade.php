@extends('funcionario::template')

@section('title','Férias')

@section('body')
<table class="table">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Periodo Inicio</th>
      <th scope="col">Periodo Fim</th>
      <th scope="col">Açôes</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data['ferias'] as $ferias)
    <tr>
      <td> {{ $ferias->id }} </td>
      <td> {{ $ferias->data_inicio }} </td>
      <td> {{ $ferias->data_fim }} </td>
      <td class="min">                  
        <a class="btn btn btn-success" href=''>Visualizar</a>     
        <a class="btn btn-warning" href=''>Editar</a>

                                <input type="submit" class="btn btn-danger" value="Deletar"/>
                        
      
    </tr>
    @endforeach
  </tbody>
</table>
 
@endsection

@section('script')


@endsection