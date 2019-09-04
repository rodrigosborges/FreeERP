@extends('funcionario::template')

@section('title','Férias')

@section('body')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Férias</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data['funcionarios'] as $funcionario)
    <tr>
      <td> {{ $funcionario->nome }} </td>
      <td>
        <a href='{{url("funcionario/ferias/controleFerias/$funcionario->id")}}' class="btn btn-primary">Gerar ferias</a>
        <a href='{{url("funcionario/ferias/listar/$funcionario->id")}}' class="btn btn-primary">Listar ferias</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
 
@endsection

@section('script')


@endsection