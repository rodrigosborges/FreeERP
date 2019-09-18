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
                        <span class="input-group-text"><i class="material-icons">calendar_today</i></span>    
                    </div>
                    <input type="date" name="data" onfocusout="checkDate()" id="data" class="form-control">
                </div>                        
            </div>

            <div class="col-4 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">local_atm</i></span>
                    </div>
                    <input type="number" name="numero" placeholder="Numero da Compra" class="form-control">
                </div>
                
            </div>

            <div class="col-4 form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">arrow_downward</i></span>
                    </div>                      
                    <input type="number" name="desconto" placeholder="Desconto da compra" class="form-control">
                </div>
            </div>
            
        </div>
        <hr>
        <div class="produtos">
            <div class="row produto ">
                <div class="col form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                        </div>
                        <select name="produtos[0][produto_id] produto_id" id="" class="form-control">
                            <option value="" selected>Selecione o produto</option>
                            @foreach($produtos as $produto)           
                                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                            @endforeach        
                        </select>                
                    </div>

                </div>
                <div class="col-3 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">add_shopping_cart</i></span>
                        </div>
                        <input type="text" class="form-control produto_quantidade" name="produtos[0][quantidade]" placeholder="Quantidade">
                    </div>                 
                </div>
                <div class="col-3 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">trending_down</i></span>
                        </div>
                        <input type="text" class="form-control produto_desconto" name="produtos[0][desconto]" placeholder="Desconto">
                    </div>  
                </div>
                <div class="col-1 d-none">
                    <button type="button" class="btn btn-danger btn-block excluir-produto"><strong>X</strong></button>
                </div>
                    

            </div>
        </div>
        <div class="text-center">
            <button type="button" id="adicionar-produto" class="btn btn-success"><strong>+</strong></button>
        </div>
        
        <button type="submit" class="btn btn-primary">Cadastrar compra</button>
        
        
    
    </form>
    


@section('script')
<script>
   
     $(document).on('click', '#adicionar-produto', function(){
            $('.excluir-produto').parent().removeClass('d-none');
            var pedido = $(".produto").last().clone();
            
            var inputs = pedido.find('select, input');
            inputs.val("");
            inputs.map((i, input)=> {
                var match = $(input).attr('name').match(/\[(\d+)]/g)[0]
                var contador = parseInt(match.replace('[','').replace(']',''))+1
                var newName = $(input).attr('name').replace(match, `[${contador}]`)
                $(input).attr('name', newName)
            })

            pedido.appendTo($(".produtos"))
        });

        $(document).on('click', '.excluir-produto',function(){
            if($('.produto').length == 2){
                $(this).closest('.produto').remove();
                $('.excluir-produto').parent().addClass('d-none');
            }else if($('.produto').length >= 2) {
                $(this).closest('.produto').remove();
            }
        });

        function checkDate() {
            var dateString = document.getElementById('data').value;
            var arrayData = dateString.split("-");
            var selectedDate = new Date(arrayData[0], arrayData[2], arrayData[1]);
            var now = new Date(); 
            if (selectedDate > now) {  //bloquear botão de cadastrar compra  
                alert("Data inválida");
            }
        }





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