@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')

<div class="container" style="justify-content: center;" id=""> 
    <div class="card">
        <div class="card-header">
            <h4>Registro de Pedido</h4>
        </div>
        <div class="row col-4 ml-2 mb-2">
            <label for="Cliente">Cliente</label>
            <input class="form-control" type="text" id="nomecliente" placeholder="insira o nome do Cliente">           
        </div>
        <div class="col-4">
            <ul class="list-group " id="listaClientes" >
            </ul>   
        </div>
    
    </div>
</div>












@endsection
@yield('js')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<script>

    function selecionar(data){
    document.getElementById("nomecliente").value = data
        
    }
        
        
    $(document).ready(function(){
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
                $('#listaClientes').empty();
                $.each(data, function(key, item){
                    $('#listaClientes').append($("<li class='list-group-item'>"+data[key].nome+" <button type='button' class='btn btn-primary btn-sm' onClick='selecionar();'>Selecionar</button></li>"))
                })
                if(data.length == 0){
                    $('#listaClientes').append($("<li class='list-group-item'>Nenhum cliente encontrado    <a class='btn btn-success btn-sm' href='{{url('/estoquemadeireira/vendas/clientes/create')}}'>Adicionar Novo</li>"))
                }
            }).fail(function(){
                console.log('fail')
            }).always(function(){

            })
        }


    })



</script>