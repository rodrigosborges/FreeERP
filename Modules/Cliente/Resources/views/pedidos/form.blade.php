@extends('cliente::template')
@section('title')
    @if(isset($pedido))
        Edição da compra - {{ $cliente->nome }}
    @else
        Cadastro Nova Compra - {{ $cliente->nome }}
    @endif
@endsection

@section('css')
<style>
.mensagem-erro{
    color: red;
    list-style-type: none;
}
</style>
@endsection

@section('body')
    <form id="form" action="{{isset($pedido) ? url('/cliente/pedido/'.$pedido->id) : url('/cliente/'.$cliente->id.'/pedido')}}" method="POST">
        @if(isset($pedido)) 
            @method('put')
        @endif
      
        <div class="row">
            <div class="col-lg-4 col-md-12 form-group">
                <label for="data">Data da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">calendar_today</i></span>    
                    </div>
                    <input type="text" required name="data" placeholder="DD/MM/AAAA" id="data" class="form-control" value="{{ isset($pedido->data) ? $pedido->data : old('data', '') }}">
                    <span class="mensagem-erro">{{$errors->first('data')}}</span>
                </div>                        
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label for="numero">Numero da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">local_atm</i></span>
                    </div>
                    <input type="text" required name="numero" placeholder="Numero da Compra" class="form-control" value="{{ isset($pedido->numero) ? $pedido->numero : old('numero', '') }}">
                    <span class="mensagem-erro">{{$errors->first('numero')}}</span>
                </div>
                
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label for="desconto">Desconto da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">arrow_downward</i></span>
                    </div>                      
                    <input type="text" required name="desconto" placeholder="Desconto da compra" class="form-control desconto" value="{{isset($pedido->desconto) ? $pedido->desconto : old('desconto', '')}}">
                    <span class="mensagem-erro">{{$errors->first('desconto')}}</span>
                </div>
            </div>
            
        </div>
        <hr>
        
        <?php
            $pedidosProdutos = old('produtos', isset($pedido) ? $pedido->produtos : [[]]);       
       
        ?>

        <div class="produtos">
            <h3>Produto(s)</h3>
                @foreach ($pedidosProdutos as $key => $prod)
                <div class="row produto ">
                    <hr>
                    <div class="col-lg col-md form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                            </div>
                         
                            <select name="produtos[{{$key}}][produto_id]" required id="" class="form-control">
                                <option value="" {{isset($pedido) ? '' : 'selected'}} disabled>Selecione um produto</option>
                                @foreach($produtos as $produto)   
                                    <option value="{{$produto->id}}" {{ (array_key_exists('produto_id', $prod) ? $prod['produto_id'] : (isset($prod->pivot) ? $prod['pivot']['produto_id'] : '')) == $produto->id ? 'selected' : '' }}   >{{$produto->nome}} | Preço: R${{$produto->preco}}</option>
                                @endforeach        
                            </select>  
                            <span class="mensagem-erro">{{$errors->first('produtos.'.$key.'.produto_id')}}</span>
                                       
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons">add_shopping_cart</i></span>
                            </div>
                            <input type="text" required class="form-control produto_quantidade" value="{{array_key_exists('quantidade', $prod) ? $prod['quantidade'] : (isset($prod->pivot) ? $prod['pivot']['quantidade'] : '')}}"  name="produtos[{{$key}}][quantidade]" placeholder="Quantidade">
                            <span class="mensagem-erro">{{$errors->first('produtos.'.$key.'.quantidade')}}</span>
                        </div>                 
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons">trending_down</i></span>
                            </div>
                            <input type="text" required class="form-control produto_desconto desconto" value="{{array_key_exists('desconto', $prod) ? $prod['desconto'] : (isset($prod->pivot) ? $prod['pivot']['desconto'] : '')}}" name="produtos[{{$key}}][desconto]" placeholder="Desconto">
                            <span class="mensagem-erro">{{$errors->first('produtos.'.$key.'.desconto')}}</span>
                        </div>  
                    </div>
                    <div class="col-lg-1 col-sm-12 form-group {{(isset($pedido) ? count($pedidosProdutos) : '') > 1 ? '' : 'd-none'}}">
                        <button type="button" class="btn btn-danger btn-block excluir-produto"><strong>X</strong></button>
                    </div>
                    <hr>
                </div>
                @endforeach
            

        </div>
        <div class="text-center">
            <button type="button" id="adicionar-produto" class="btn btn-success"><strong>+</strong></button>
        </div>
        
        <button class="btn btn-primary" >{{isset($pedido) ? 'Atualizar compra' : 'Cadastrar compra'}}</button>

    </form>


@endsection

@section('script')
<script src="{{Module::asset('cliente:js/views/pedido/validations.js')}}"></script>
<script src="{{Module::asset('cliente:js/views/pedido/inputmask.js')}}"></script>
<script src="{{Module::asset('cliente:js/views/pedido/pedido.js')}}"></script>

@endsection