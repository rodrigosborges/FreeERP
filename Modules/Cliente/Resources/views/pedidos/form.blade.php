@extends('cliente::template')
@section('title')
Cadastro Nova Compra - {{ $cliente->nome }}
@endsection
@section('body')
    <form action="" id="form">
        <div class="row">
            <div class="col-lg-4 col-md-12 form-group">
                <label for="data">Data da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">calendar_today</i></span>    
                    </div>
                    <input type="date" required name="data" id="data" class="form-control">
                </div>                        
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
                <label for="numero">Numero da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">local_atm</i></span>
                    </div>
                    <input type="text" required name="numero" placeholder="Numero da Compra" class="form-control">
                </div>
                
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 form-group">
            <label for="desconto">Desconto da compra:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="material-icons">arrow_downward</i></span>
                    </div>                    
                    <input type="text" required name="desconto" placeholder="Desconto da compra" class="form-control desconto">
                </div>
            </div>
            
        </div>
        
        <div class="produtos">
            <h3>Produto(s)</h3>
            <hr>
            <div class="row produto form-group ">
                <div class="col-lg-4 col-md-12 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">format_list_numbered</i></span>
                        </div>
                        <select name="produtos[][produto_id]" required class="form-control">
                            <option value="" selected>Selecione o produto</option>
                            @foreach($produtos as $produto)           
                                <option value="{{$produto->id}}">{{$produto->nome}}</option>
                            @endforeach        
                        </select>                
                    </div>

                </div>
                <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">add_shopping_cart</i></span>
                        </div>
                        <input type="text" required class="form-control" name="produtos[][quantidade]" placeholder="Quantidade">
                    </div>                 
                </div>
                <div class="col-lg-3 col-md-6 col-sm-11 form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="material-icons">trending_down</i></span>
                        </div>
                        <input type="text" required class="form-control desconto" name="produtos[][desconto]" placeholder="Desconto">
                    </div>  
                </div>
                <div class="col-lg-1 col-sm-12 d-none">
                    <button type="button" class="btn btn-danger btn-block excluir-produto"><strong>X</strong></button>
                </div>
                <hr>  

            </div>
        </div>
        <div class="text-center">
            <button type="button" id="adicionar-produto" class="btn btn-success"><strong>+</strong></button>
        </div>
        
        <button type="submit" class="btn btn-primary sendForm">Cadastrar compra</button>
        
        
    
    </form>

@endsection
@section('script')
    <script src="{{Module::asset('cliente:js/views/pedido/validations.js')}}"></script>
    <script src="{{Module::asset('cliente:js/views/pedido/inputmask.js')}}"></script>
    <script>
        $(document).on('click', '#adicionar-produto', function(){
            $('.excluir-produto').parent().removeClass('d-none');
            var pedido = $(".produto").first().clone()
            pedido.find('select, input').val("")
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
                'placeholder': '',
                'min': 0,
                'max': 100,
                'rightAlign': false
            });
        });
    </script>
@endsection