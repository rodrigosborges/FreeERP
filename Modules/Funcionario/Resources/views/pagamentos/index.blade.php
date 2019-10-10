@extends('funcionario::template')

@section('title','Pagamentos')

@section('body')
<!-- Search form -->
<div class="row">
  <div class="col-md-8">
      <form id="form">
          <div class="form-group">
              <div class="input-group">
                  <input id="search-input" class="form-control" type="text" name="search" />
                  <i id="search-button" class="btn btn-info material-icons ml-2">search</i>
              </div>
          </div>
      </form>
  </div>
</div>

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
        <a href='{{ url("funcionario/pagamento/$funcionario->id/show") }}' class="btn btn-secondary">Visualizar Pagamento</a>
        
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