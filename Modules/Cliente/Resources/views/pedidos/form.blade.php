@extends('cliente::template')
@section('title')
Cadastro Nova Compra - {{ $cliente->nome }}
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
        <ul class="mensagem-erro">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <div class="row">
            <div class="col-lg-4 col-md-12 form-group">
                <label for="data">Data da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">calendar_today</i></span>    
                    </div>
                    <input type="text" required name="data" placeholder="DD/MM/AAAA" id="data" class="form-control" value="{{ isset($pedido->data) ? $pedido->data : old('data', '') }}">
                    
                </div>                        
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label for="numero">Numero da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">local_atm</i></span>
                    </div>
                    <input type="text" required name="numero" placeholder="Numero da Compra" class="form-control" value="{{ isset($pedido->numero) ? $pedido->numero : old('numero', '') }}">
                </div>
                
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label for="desconto">Desconto da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">arrow_downward</i></span>
                    </div>                      
                    <input type="text" required name="desconto" placeholder="Desconto da compra" class="form-control desconto" value="{{isset($pedido->desconto) ? $pedido->desconto : old('desconto', '')}}">
                </div>
            </div>
            
        </div>
        <hr>
        <div class="produtos">
            <h3>Produto(s)</h3>
        
            @if(isset($pedido))
                @foreach ($pedido->produtos as $key => $prod)
                <div class="row produto ">
                    <hr>
                    
                    <div class="col-lg col-md form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                            </div>
                            <select name="produtos[{{$key}}][produto_id]" required id="" class="form-control">
                                @foreach($produtos as $produto)   
                                    
                                    @if ($produto->id == $prod->pivot->produto_id)
                                    <option value="{{$produto->id}}" selected>{{$produto->nome}} | Preço: R${{$produto->preco}}</option>
                                    @else
                                    <option value="{{$produto->id}}" >{{$produto->nome}} | Preço: R${{$produto->preco}}</option>
                                    @endif
                                    
                                @endforeach        
                            </select>                
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons">add_shopping_cart</i></span>
                            </div>
                            <input type="text" required class="form-control produto_quantidade" value="{{$prod->pivot->quantidade}}"  name="produtos[{{$key}}][quantidade]" placeholder="Quantidade">
                        </div>                 
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="material-icons">trending_down</i></span>
                            </div>
                            <input type="text" required class="form-control produto_desconto desconto" value="{{$prod->pivot->desconto}}" name="produtos[{{$key}}][desconto]" placeholder="Desconto">
                        </div>  
                    </div>
                    <div class="col-lg-1 col-sm-12 form-group d-none">
                        <button type="button" class="btn btn-danger btn-block excluir-produto"><strong>X</strong></button>
                    </div>
                    <hr>
                </div>
                @endforeach
            @else
            <div class="row produto ">
                <hr>
                <div class="col-lg col-md form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                        </div>
                        <select name="produtos[0][produto_id]" required id="" class="form-control">
                            <option value="" selected>Selecione o produto</option>
                            @foreach($produtos as $produto)           
                                <option value="{{$produto->id}}">{{$produto->nome}} | Preço: R${{$produto->preco}}</option>
                            @endforeach        
                        </select>                
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">add_shopping_cart</i></span>
                        </div>
                        <input type="text" required class="form-control produto_quantidade"  name="produtos[0][quantidade]"value="{{old('produtos[0][quantidade]', '')}}" placeholder="Quantidade">
                    </div>                 
                </div>
                <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">trending_down</i></span>
                        </div>
                        <input type="text" required class="form-control produto_desconto desconto" name="produtos[0][desconto]" value="{{old('produtos[0][desconto]', '')}}" placeholder="Desconto">
                    </div>  
                </div>
                <div class="col-lg-1 col-sm-12 form-group d-none">
                    <button type="button" class="btn btn-danger btn-block excluir-produto"><strong>X</strong></button>
                </div>
                <hr>
            </div>
            @endif

        </div>
        <div class="text-center">
            <button type="button" id="adicionar-produto" class="btn btn-success"><strong>+</strong></button>
        </div>
        
        <button class="btn btn-primary" >Cadastrar compra</button>

    </form>


@endsection
@section('script')
<script src="{{Module::asset('cliente:js/views/pedido/validations.js')}}"></script>
<script src="{{Module::asset('cliente:js/views/pedido/inputmask.js')}}"></script>
<script>
    $(document).on('click', '#adicionar-produto', function(){
        $('.excluir-produto').parent().removeClass('d-none');
        var pedido = $(".produto").last().clone();

        pedido.find('.error').remove();
        pedido.find('.has-error').removeClass('has-error')

        var inputs = pedido.find('select, input');
        inputs.val("");
        inputs.map((i, input)=> {
            var match = $(input).attr('name').match(/\[(\d+)]/g)[0]
            var contador = parseInt(match.replace('[','').replace(']',''))+1
            var newName = $(input).attr('name').replace(match, `[${contador}]`) 
            $(input).attr('name', newName)
        })

        pedido.appendTo($(".produtos"));
        pedido.find("[name$='[quantidade]']").removeAttr('aria-describedby').rules('add', {digits: true, required:true, maxlength: 6})
        pedido.find("[name$='[desconto]']").removeAttr('aria-describedby').rules('add', {required:true}) 
        pedido.find("[name$='[produto_id]']").removeAttr('aria-describedby').rules('add', {required:true})
        

        pedido.find("[name$='[desconto]']").inputmask("decimal", {
            'alias': 'numeric',
            'groupSeparator': '',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            'prefix': '',
            'suffix':' %',
            'placeholder': '',
            'min': 0,
            'max': 100,
            'rightAlign': false,
            'removeMaskOnSubmit':true
        });
    });
    $(document).on('click', '.excluir-produto',function(){
        if($('.produto').length == 2){
            $(this).closest('.produto').remove();
            $('.excluir-produto').parent().addClass('d-none');
        }else if($('.produto').length >= 2) {
            $(this).closest('.produto').remove();
        }
    });

    $(document).ready(function(){
        $(".desconto").inputmask("decimal", {
            'alias': 'numeric',
            'groupSeparator': '',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ".",
            'digitsOptional': false,
            'allowMinus': false,
            'prefix': '',
            'suffix':' %',
            'placeholder': '',
            'min': 0,
            'max': 100,
            'rightAlign': false,
            'removeMaskOnSubmit':true,
        });
        $('#data').mask('00/00/0000');
    });

</script>
@endsection