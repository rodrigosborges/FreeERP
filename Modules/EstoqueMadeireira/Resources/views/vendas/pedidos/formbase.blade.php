@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')
 <style>
 .form-control-borderless {
    border: none;
}

.form-control-borderless:hover, .form-control-borderless:active, .form-control-borderless:focus {
    border: none;
    outline: none;
    box-shadow: none;

}
</style>
<div class="container" id="selecionarCliente">
        <div class="row justify-content-center">
            <div class="col-12">
                <form class="card">
                    <div class="card-body row no-gutters align-items-center">
                        <div class="col-auto">
                            <i class="fas fa-search h4 text-body"></i>
                        </div>
                        <!--end of col-->
                        <div class="col">
                            <input class="form-control form-control-borderless" id="nomecliente" type="search" placeholder="Search topics or keywords">
                        </div>
                        <!--end of col-->
                        <div class="col-auto">
                            <button class="btn btn-sm btn-success" type="submit">Search</button>
                        </div>
                        <!--end of col-->
                    </div>
                </form>
            </div>
        <!--end of col-->
            
    </div>
    
    <div class="row">
        <div class="col-12">
            <ul class="list-group " id="listaClientes">
            </ul>   
        </div>
    
    </div>
</div>

<div class="container" id="selecionarEndereco">
    <div class="row">
        <div class="col-12 text-right">
            <button type="button" class="btn btn-primary" onClick="voltar();">Voltar</button>
        </div>
        <h4>Selecione um endereço</h4>
    </div>
</div>

<div class="container" id="produtos">
    <div class="row">
        <input type="text" placeholder="Buscar produto..." id="nomeProduto" class="form-control">
        <button class="btn btn-primary" type="button" onClick="adicionarProduto();">Adicionar</button>
    </div>
    <table class="table" id="tabelaProduto">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Primeiro</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
    </tr>
  </tbody>
</table>

</div>

@endsection
@yield('js')



<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>


<script>
        var itens = [];

        foreach(inserir itemPedido)
        function adicionarProduto(){
            $('#tabelaProduto').append("<tr><td>0</td><td>"+$('#nomeProduto').val()+"</td></tr>")
        }
        function voltar(){
            $('#selecionarCliente').show();
            $('#selecionarEndereco').hide();
        }
        function selecionar(){
            $('#selecionarCliente').hide();
            $('#selecionarEndereco').show();
        }

    $(document).ready(function(){
        $('#selecionarEndereco').hide();
        $('#nomecliente').keyup(function(){
            var valor = $('#nomecliente').val()
            buscarcliente(valor)
        })

        function buscarcliente(valor){
            $.ajax({
                url:'/buscacliente',
                type:'GET',
                data:{
                    valor:valor,
                    '_token': $('input[name=_token]').val(),
                }
            }).done(function(data){
                // for(var i = 0; i < data.length; i++){
                //     var add = $("<li class='list-group-item'>"+data[i].nome+"</li>");
                //     $('#listaClientes').append(add); 
                // }
                $('#listaClientes').empty();
                $.each(data, function(key, item){
                    $('#listaClientes').append($("<li class='list-group-item'>"+data[key].nome+" <button type='button' class='btn btn-primary btn-sm' onClick='selecionar();'>Selecionar</button></li>"))
                })

                if(data.length == 0){
                    $('#listaClientes').append($("<li class='list-group-item'>Nenhum cliente encontrado</li>"))
                }

            }).fail(function(){
                console.log('fail')
            }).always(function(){

            })
        }
        
        
    })
</script>


