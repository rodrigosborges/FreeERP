@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')

<div class="container" style="justify-content: center;" id=""> 
    <div class="card">
        <div class="card-header">
            <h4>Registro de Pedido</h4>
        </div>
        <div id="selecionarCliente">
            <div class="row col-4 ml-2 mb-2">
                <label for="Cliente">Cliente</label>
                <input class="form-control" type="text" value="" id="nomecliente" placeholder="insira o nome do Cliente">           
            </div>
            <div class="col-4">
                <ul class="list-group " id="listaClientes">
                </ul>   
            </div>
        </div>
        <div class="row col-12" id="clienteSelecionado">
            <div class="form-group col-5 ml-2 mb-2">
                <label for="nomeSelecionado">Cliente Selecionado</label>
                <input type="text" id="nomeSelecionado" disabled class="form-control">
                <button class="btn btn-primary btn-sm mt-2" style="justify content:flex-end;" onClick="removerCliente();">Alterar</button>
            </div>
        </div>

        <div class="row col-12 ml-2 mt-4" id="produtos">
            <label for=""> <h2> Selecionar produtos</h2></label>

        </div>
    </div>
</div>












@endsection
@yield('js')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<script>
    var d = [];    
    var cliente = '';
    $(document).ready(function(){
        $('#produtos').hide();
        $('#clienteSelecionado').hide();
        $('#nomecliente').keyup(function(){
            var valor = $('#nomecliente').val()
            buscarcliente(valor)
        })
    })
    function removerCliente(){
        cliente = '';
        $('#divNome').hide();
        $('#selecionarCliente').show();
        
    }
    function selecionar(data){
        cliente = data;
        document.getElementById('nomecliente').value = d[cliente].nome;
        $('#selecionarCliente').hide();
        $('#clienteSelecionado').show();
        $('#produtos').show();
        document.getElementById('nomeSelecionado').value = d[cliente].nome;
        document.getElementById('nomeSelecionado').type = 'text';
        
    }
    // function buscarProduto(valor){
    //     $.ajax({
    //         url: '/buscaproduto',
    //         type: 'GET',
    //         data:{
    //                 valor:valor,
    //                 '_token': $('input[name=_token]').val(),
    //         }
    //     }).done(function(data){
    //         $.each(data, function(key, item){
    //             $('#listaProdutos')
    //         })
    //     })
    // }
    function buscarcliente(valor){
            $.ajax({
                url:'/buscacliente',
                type:'GET',
                data:{
                    valor:valor,
                    '_token': $('input[name=_token]').val(),
                }
            }).done(function(data){
                d = data;
                $('#listaClientes').empty();
                $.each(data, function(key, item){
                    $('#listaClientes').append($("<li class='list-group-item'>"+data[key].nome+" <button type='button' value='"+key+"' class='btn btn-primary btn-sm' onClick='selecionar(this.value)'>Selecionar</button></li>"))
                })
                if(data.length == 0){
                    $('#listaClientes').append($("<li class='list-group-item'>Nenhum cliente encontrado    <a class='btn btn-success btn-sm' href='{{url('/estoquemadeireira/vendas/clientes/create')}}'>Adicionar Novo</li>"))
                }
            }).fail(function(){
                console.log('fail')
            }).always(function(){
            })
    }
</script>