@extends('cliente::template')
@section('title')
Nova Compra - {{ $cliente->nome }}
@endsection
@section('body')

<div class="container border">

    <form action="" class="">

        <div class="form-group form-row">
            <div class="col-3">
            <label for="data-pedido">Data da Compra</label>
                <input type="date" name="data-pedido" id="data-pedido" class="form-control" placeholder="Data da Compra" required>
            </div>
            <div class="col-3 pt-2">
                <label for="num-pedido"></label>
                <input type="text" name="num-pedido" id="numero" class="form-control" placeholder="Numero da Compra">
            </div>
        </div>
        
        
        <div class="input-group">
            <div class="input-group-prepend col-6">
                <span class="input-group-text purple lighten-3" id="basic-text1">
                    <i class="material-icons" aria-hidden="true">search</i></span>
            
                <select class="form-control" name="produto_id" id="lista">
                    @foreach ($produtos as $produto)
                <option value="{{$produto->id}}">{{$produto->codigo}} - {{$produto->nome}} - R$ {{$produto->preco}}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="col col-2">
                <input type="number" min="1" class="form-control" name="qtde" id="qtde" placeholder="Qtde">
            </div>

            <div class="col col-2 input-group">
                <input type="number" min="0" class="form-control" name="desconto" id="desconto"  
                                aria-label="0,0%" aria-describedby="basic-addon2" placeholder="Desconto">
                    <div class="input-group-append ">
                            <span class="input-group-text" id="basic-addon2">%</span>
                    </div>
            </div>

            <div class="col-2 ">
                <button type="button" onclick="add_item()" class="btn btn-primary" style="width: 100%;">Adicionar</button>
            </div>
        
        </div>
    </form>
    <hr />
    <div id="itens_adicionados" class="border"> 
        <table class="table table-striped bordered text-center col-md-12" id="adicionados">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Descricao</th>
                    <th>Preco</th>
                    <th>Qtde</th>
                    <th>Desconto UN</th>
                    <th>Vl Total</th>
                    <th>Opções</th>   
                </tr>
                    </thead>
        </table>
    </div>
</div>
<script>

var itens_compra = [];

    function add_item(){
        selecionado = document.getElementById("lista");
        opt = selecionado.options[selecionado.selectedIndex]; // pegar texto        

        dados = opt.text.split("-");

        qtde = document.getElementById("qtde").value;
        dados.push(qtde);
        desconto = document.getElementById("desconto").value;
        dados.push(desconto);

        novaTabela(dados);
        

        itens_compra.push(selecionado.value);
    }

    function novaTabela(dados){
        // alert("Funcao" + dados);

        var tBody = document.createElement("tbody");
        var tabela = document.getElementById('adicionados');

            // creates a table row
            var row = document.createElement("tr");

            for (var i = 0; i < 5; i++) {
                // Create a <td> element and a text node, make the text
                // node the contents of the <td>, and put the <td> at
                // the end of the table row
                console.log(i + " --- " +dados[i]);

                var cell = document.createElement("td");
                var cellText = document.createTextNode( dados[i] );
                
                cell.appendChild(cellText);
                row.appendChild(cell);
            }
        // add the row to the end of the table body
                tBody.appendChild(row);

        // put the <tbody> in the <table>
        tabela.appendChild(tBody);
        // appends <table> into <body>
    }


</script>
@endsection