@extends('cliente::template')
@section('title')
Cadastro Nova Compra - {{ $cliente->nome }}
@endsection
@section('body')


    <form action="" class="">
        <div class="row">
            <div class="col-4 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>    
                    </div>
                    <input type="date" name="data" class="form-control">
                </div>                        
            </div>

            <div class="col-4 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                    </div>
                    <input type="number" name="numero" placeholder="Numero da Compra" class="form-control">
                </div>
                
            </div>

            <div class="col-4 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                    </div>                    
                    <input type="number" name="desconto" placeholder="Desconto da compra" class="form-control">
                </div>
            </div>
            
        </div>
        <div class="produtos">
            <div class="row produto ">
                <div class="col-4 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                        </div>
                        <select name="produtos[][produto_id]" id="" class="form-control">
                            @foreach($produtos as $produto)           
                                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                            @endforeach        
                        </select>                
                    </div>                            
                </div>
                <div class="col-4 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                        </div>
                        <input type="text" class="form-control" name="produtos[][quantidade]" placeholder="Quantidade">
                    </div>                 
                </div>
                <div class="col-4 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                        </div>
                        <input type="text" class="form-control" name="produtos[][desconto]" placeholder="Desconto do Produto">
                    </div>  
                </div>

            </div>
        </div>
        <button type="button" id="adicionar-produto" class="btn btn-success">Adicionar</button>
        <button type="button" id="excluir-produto" class="btn btn-danger">Excluir</button>
        
    
    </form>
    


@section('js')
<script>
     $('#adicionar-produto').click(function(){
            var pedido = $(".produto").first().clone()
            pedido.find('select, input').val("")
            pedido.appendTo($(".produtos"))
        });
        $('#excluir-produto').click(function(){
            if ($(".produto").length > 1) {
                $(".produto").last().remove()
            }
        });




// var itens_compra = [];
// function add_item(){
//     var opt = $("[name='produto_id'] option:selected");     
//     dados = opt.text().split("-");
//     novaTabela(dados);
//     alert(opt.val() + " " + opt.text());
//     itens_compra.push(opt.val());
// }
// $("#add").click(function(){
//     var opt = $("[name='produto_id'] option:selected");     
//     console.log();
//     var nome = opt.attr("data-nome");
//     var preco = opt.attr("data-preco");
//     var codigo = opt.attr("data-codigo")
//     var quantidade = $('#qtde').val();
//     var desconto = $('#desconto').val();
//      //CRIAR TBODY
//     var row = "<tr><td>" +  codigo + "</td><td>" + nome + "</td><td>" + preco +"</td><td>" + quantidade + "</td><td>" + desconto + "</td></tr>";
//     $("#adicionados tbody").append(row);
// });

</script>
@endsection
@endsection