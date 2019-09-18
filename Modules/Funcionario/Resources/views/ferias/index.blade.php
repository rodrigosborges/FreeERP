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
      <td class="d-flex justify-content-end">
        <a href='{{url("funcionario/ferias/controleFerias/$funcionario->id")}}' class="btn btn-success ">Agendar ferias</a>
        <a href='{{url("funcionario/ferias/$funcionario->id/edit")}}' class="btn btn-warning ml-3 ">Editar</a>
        <a href='{{url("funcionario/ferias/$funcionario->id/show")}}' class="btn btn-secondary ml-3">Gerar Aviso</a>
        <a href='{{url("funcionario/ferias/listar/$funcionario->id")}}' class="btn btn-primary ml-3">Listar ferias</a>
        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
 
@endsection

@section('script')


@endsection