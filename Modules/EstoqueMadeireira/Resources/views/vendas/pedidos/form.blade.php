@extends('estoquemadeireira::vendas.vendastemplate')

@section('title', 'Pedidos')

@section('body')

<div class="container" style="justify-content: center;" id=""> 
    <div class="card">
        <div class="card-header">
            <h4>Registro de Pedido</h4>
        </div>
        <div id="selecionarCliente">
            <div class="row col-4 ml-2 mb-2 mt-2">
                <label for="Cliente"><h4>Cliente</h4></label>
                <input class="form-control" type="text" value="" id="nomecliente" placeholder="insira o nome do Cliente">           
            </div>
            <div class="col-4">
                <ul class="list-group "id="listaClientes">  
                </ul>   
            </div>
        </div>
            <div id="clienteSelecionado">
                <div class="row col-12">
                    <div class="form-group col-5 ml-2 mb-2 mt-2">
                        <label for="nomeSelecionado"><h4>Cliente Selecionado</h4></label>
                        <input type="text" id="nomeSelecionado" disabled class="form-control">
                        <button class="btn btn-primary btn-sm mt-2" style="justify content:flex-end;" onClick="removerCliente();">Alterar</button>
                    </div>        
                </div>
                <div class="row col-12" id="produtos">
                <div class="form-group col-5 ml-2 mt-2 mb-2" >
                    <label for="selecionarProduto"><h4> Selecionar produtos</h4></label>
                    <input class="form-control" type="text" value="" id="selecionarProduto">
                </div> 
                <div class="col-4">
                <ul class="list-group "id="listaProdutos"></ul>        
                </div>
                   <table class="table" id="tabelaProdutos">
                        <thead>
                            <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Desconto</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Remover</th>
                            </tr>
                        </thead>
                        <tbody id="itensTabela">                                               
                        </tbody>
                    </table>
                   </div>           
            
            
        </div>
    </div>
</div>
<input type="hidden" id="md" data-toggle="modal" data-target="#addProduto" />

<div class="modal fade" id="addProduto" tabindex="-1" role="dialog" aria-labelledby="modalProduto" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalInsumo">Adicionar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <input type="hidden" id="indexProduto" value="">
      <div class="modal-body">
        <div class="form-group col-12">
            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" required id="quantidade" value="1" class="form-control">
        </div>
        <div class="form-group col-12">
            <label for="quantidade">Desconto</label>
            <input type="text" name="desconto" required id="desconto" onKeyUp="verificaPreco(this);" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button id="btnAdd" type="button" class="btn btn-primary" onclick="selecionarProduto();" data-dismiss="modal">Adicionar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>









@endsection
@yield('js')
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

<script>
    var produtos = [];
    var d = [];   
    var d2 = []; 
    var cliente = '';
    
    
    $(document).ready(function(){
        $('#produtos').hide();
        $('#clienteSelecionado').hide();
        $('#tabelaProdutos').hide();
        $('#nomecliente').keyup(function(){
            var valor = $('#nomecliente').val()
            buscarcliente(valor)
        })
        $('#selecionarProduto').keyup(function(){
            var valor = $('#selecionarProduto').val()
            buscarProduto(valor)
        })
    })

    function adicionarProduto(valor){
        //Abre modal
        $('#indexProduto').val(valor);
        $('#quantidade').val('1');
        $('#desconto').val('');
        $("#md").click()
    }

    //FUNÇÃO PARA ADICIONAR UM NOVO PRODUTO VC ESTA AQUI GABRIEL FREITAS

    function selecionarProduto(){
        produtos.push(d2[$('#indexProduto').val()], $('#quantidade').val(), $('#desconto').val())
        preencherTabela()
        // produtos.push(d2[id]);
        // console.log(produtos)

        // console.log(id)
        // console.log("descrição"+d2[id].descricao)
        // $('#tabelaProdutos').show();
        // var linha = "<tr><td>"+ d2[id].nome+"</td><td><input class='form-control' type='number'  value='1' id='quantidade'></td><td> <input class='form-control' type='number' onKeyUp='verificaPreco(this);' id='desconto'></td><td><input class='form-control' disabled type='text' id='valor'></td><td><button class='btn btn-danger btn-sm'>X</button></td></tr>"

        // $('#tabelaProdutos').append(linha);
    }
    
    function preencherTabela(){
        $('#tabelaProdutos').show();
        var table = document.getElementById('itensTabela');
        table.innerHTML = "";
        for(var i = 0; i < produtos.length; i+=3 ){
            var row = document.createElement('tr');
            row.insertCell(0).innerHTML = produtos[i].nome;
            row.insertCell(1).innerHTML = '<input type="number" value="'+produtos[i+1]+'" disabled class="form-control">';
            row.insertCell(2).innerHTML = '<input type="text" value="'+produtos[i+2]+'" disabled class="form-control">';
            document.getElementById('itensTabela').appendChild(row);
        }
    }
    
    
    //ALTERAR CLIENTE, RESETA TUDO
    function removerCliente(){
        cliente = '';
        $('#divNome').hide();
        $('#selecionarCliente').show();
        $('#clienteSelecionado').hide();
        
    }

    // //BOTÃO DE SELECIONAR O PRODUTO
    // function selecionarProduto(data){
    //     produtos.push(data);
    //     document.getElementById('selecionarProduto').value = d2[produtos].nome;
    //     document.getElementById('selecionarProduto').type = 'text';
    // }

    //SELECIONAR O CLIENTE E DEFINIR ELE NO INPUT
    function selecionar(data){
        cliente = data;
        document.getElementById('nomecliente').value = d[cliente].nome;
        $('#selecionarCliente').hide();
        $('#clienteSelecionado').show();
        $('#produtos').show();
        document.getElementById('nomeSelecionado').value = d[cliente].nome;
        document.getElementById('nomeSelecionado').type = 'text';
        
    }


    //FUNÇÃO AJAX PARA PUXAR OS ESTOQUES
    function buscarProduto(valor){
        $.ajax({
            url: '/buscaproduto',
            type: 'GET',
            data:{
                valor:valor,
                '_token': $('input[name=_token]').val(),
            }
        }).done(function(data){
            d2 = data;
         
            $('#listaProdutos').empty();
            $.each(data, function(key, item){
                $('#listaProdutos').append($("<li class='list-group-item'>"+item.nome+"<button type='button'value='"+key+"' class='btn btn-primary btn-sm' onClick='adicionarProduto(this.value);'>Selecionar Produto</button></li>"))
            })
            if(data.length == 0){
                $('#listaProdutos').append($("<li class='list-group-item'>Nenhum produto encontrado</li>"))
            }
        }).fail(function (fail){
            console.log(fail)
        }).always(function (){
            
        })
    }

    //FUNÇÃO AJAX PRA PUXAR O CLIENTE
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

    function verificaPreco(i){
        var v = i.value.replace(/\D/g,'');
        v = (v/100).toFixed(2) + '';
        v = v.replace(",", ".");
        v = v.replace(/(\d)(\d{3})(\d{3}),/g, "$1$2$3.");
        v = v.replace(/(\d)(\d{3}),/g, "$1$2.");
        i.value = v;
    
    }

</script>