@extends('funcionario::template')

@section('title','Pagamentos')

@section('body')
<!-- Search form -->
<form class="form-inline ml-auto">
  <div class="md-form my-0">
    <input class="form-control" name="search" type="text" placeholder="Nome" aria-label="Search">
  </div>
  <button class="btn btn-primary btn-md my-0 ml-sm-2" type="submit">Pesquisar</button>
</form>

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
<script>
  $( document ).ready(function() {
    $('.form-control').change(function (){
      var search = $(this).val();
      $.ajax({
          url: main_url+"/funcionario/pagamento",
          type: 'GET',
          data: search,
          success: function(data) {
            
          }
      });

    })
    
  }); 
</script>
@endsection