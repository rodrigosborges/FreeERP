@extends('funcionario::template')

@section('title','Pagamentos')

@section('body')
<table class="table">
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
    @foreach($data['funcionarios'] as $funcionario)
    <tr>
      <td> {{ $funcionario->nome }} </td>
      <td>
        <a href='{{url("funcionario/pagamento/novoPagamento/$funcionario->id")}}' class="btn btn-success">Criar Pagamento</a>
        <!-- <a href='{{url("funcionario/pagamento/$funcionario->id/edit")}}' class="btn btn-warning">Editar</a> -->
        <!--<a href='{{url("funcionario/ferias/$funcionario->id/show")}}' class="btn btn-secondary">Gerar Aviso</a>-->
        <a href='{{url("funcionario/pagamento/listar/$funcionario->id")}}' class="btn btn-primary">Listar Pagamento</a>
        
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
 
@endsection

@section('script')