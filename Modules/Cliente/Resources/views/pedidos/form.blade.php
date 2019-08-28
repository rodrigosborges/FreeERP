@extends('cliente::template')
@section('title')
Nova Compra - {{ $cliente->nome }}
@endsection
@section('body')

<div class="container border">

    <form action="" class="">

        <div class="form-group">
            <div class="col-3">
            <label for="data-pedido">Data da Compra</label>
                <input type="date" name="data-pedido" id="data-pedido" class="form-control" placeholder="Data da Compra" required>
            </div>
            <div>
                <label for="num-pedido">Numero da Compra</label>
                <input type="text">
            </div>
        </div>
                
        <div class="input-group">
            <div class="input-group-prepend col-6">
                <span class="input-group-text purple lighten-3" id="basic-text1">
                    <i class="material-icons" aria-hidden="true">search</i></span>
            
                <select class="form-control" name="produto_id">
                    @foreach ($produtos as $produto)
                        <option value="{{$produto->id}}">{{$produto->codigo}} - {{$produto->nome}}</option>
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
                <button type="submit" class="btn btn-primary" style="width: 100%;">Adicionar</button>
            </div>

        </div>
    </form>
    <hr />
    <div id="itens_adicionados" class="border" style="min-width: 30%; width: 40%;"> 
        <ul>
            @foreach ($produtos as $produto)
                <li>{{$produto->nome}}</li>
            @endforeach
        </ul>
    
    
    </div>


</div>

@endsection