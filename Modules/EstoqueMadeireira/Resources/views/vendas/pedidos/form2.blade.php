@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')

<div class="container col-12" style="justify-content: center;" id=""> 
    <div class="card">
        <div class="card-header">
            <h5>Registro de Pedido</h5>
        </div>
        <div id="selecionarCliente">
            <div class="row col-4 ml-2 mb-2">
                <label for="Cliente"><h5>Cliente</h5></label>
                <input class="form-control" type="text" value="" id="nomecliente" placeholder="insira o nome do Cliente">           
            </div>
            <div class="col-4">
                <ul class="list-group" id="listaClientes">
                </ul>   
            </div>
        </div>
        <div class="row col-12" id="clienteSelecionado">
            <div class="form-group col-4 mt-2 ml-2 mb-2">
                <label for="nomeSelecionado"><h5>Cliente Selecionado</h5></label> 
                <input type="text" id="nomeSelecionado" disabled class="form-control">
                <button class="btn btn-primary btn-sm mt-2" style="justify content:flex-end;" onClick="removerCliente();">Alterar</button>
            </div>
        </div>

        <div class="container ml-2 " id="produtos">
            <div class="row col-4 mb-2">
                <label for="produto"><h5>Selecione o Produto</h5></label>
            </div>
            <table class="table col-8 ml-2" id="tabelaProduto">
            <thead>
                <tr>
                <th scope="col">Produto</th>
                <th scope="col">quantidade</th>
                <th scope="col">Desconto</th>               
                <th scope="col">Preço</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="col"><input type="text" class="form-control" placeholder="Produto.." ></th>
                <th scope="col"><input type="text" class="form-control" placeholder="quantidade"></th>
                <th scope="col"><input type="numeric" onKeyUp="verificaPreco(this);" placeholder="desconto (se houver)" class="form-control"></th>
                <th scope="col"><input disabled type="numeric" onKeyUp="verificaPreco(this);" placeholder="" class="form-control"></th>
                </tr>
            </tbody>
        </table>
        <div class="row" style="flex-end;">
            <button class="btn btn-primary btn-md mb-2 mr-4" type="button" onClick="adicionarProduto();">Adicionar outro</button>
            <button class="btn btn-success btn-md mb-2 mr-4"   type="submit">Cadastrar Pedido</button>
        </div>
     </div>
</div>

</div>












@endsection
@yield('js')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<script>
    var d = [];    
    var cliente = '';
    var produtos = [];
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
        $('#clienteSelecionado').hide();
        $('#produtos').hide();
        
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

    function buscarProduto(valor){
        $.ajax({
            url: '/buscaproduto',
            type: 'GET',
            data:{
                    valor:valor,
                    '_token': $('input[name=_token]').val(),
            }
        }).done(function(data){
            $.each(data, function(key, item){
                $('#listaProdutos')
            })
        })
    }


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

    function adicionarProduto(){
            // $('#tabelaProduto').append("<tr><td>0</td><td>"+$('#nomeProduto').val()+"</td></tr>")
            $('#tabelaProduto').append("<th scope='col'><input type='text' class='form-control' placeholder='Produto..'></th>")
            $('#tabelaProduto').append("<th scope='col'><input type='text' class='form-control' placeholder='quantidade'></th>")
            $('#tabelaProduto').append("<th scope='col'><input type='numeric' onKeyUp='verificaPreco(this);' placeholder='desconto (se houve)' class='form-control'></th>")
            $('#tabelaProduto').append("<th scope='col'><input disabled type='numeric' onKeyUp='verificaPreco(this);' placeholder='' class='form-control'></th>")
                 
    }

    function verificaPreco(i){
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    
    }

</script>