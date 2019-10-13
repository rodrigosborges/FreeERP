@extends('assistencia::layouts.master')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Cadastro do cliente</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <a href="{{url('/assistencia')}}"><i class="material-icons mr-2">home</i></button></a>
                <a href="{{route('cliente.localizar')}}"><i class="material-icons mr-2">arrow_back</i></button></a>
            </div>
        </div>

        <div class="row justify-content-center">
            <form class="col-12" id="form" action="{{route('cliente.salvar')}}" method="post">
                {{ csrf_field() }}
                <div>
                    @include('assistencia::paginas.clientes._form')
                </div>
                <div class="text-center">
                    <button class="btn btn-success">Cadastrar</button>
                </div>
            </form>
        </div>

    </div>
</div>

@stop

@section('js')
<script>
$(document).ready(function() {

    $('.cpf-mask').mask("000.000.000-00")
    $('.cep').mask("00000-000")
    var phone = document.querySelector(".telefone");
    if (phone.length > 10) {
        $('.telefone').mask("(00) 0 0000-0000")
    } else {
        $('.telefone').mask("(00) 0000-0000")
    }
        
    });

    var SPMaskBehavior = function(val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        spOptions = {
            onKeyPress: function(val, e, field, options) {
                field.mask(SPMaskBehavior.apply({}, arguments), options);
            }
        };

    $('.cel_sp').mask(SPMaskBehavior, spOptions);


    $('#form').validate({
    rules: {
        "nome": {
            letras : true,
            maxlength: 100,
        },
        "email": {
            maxlength: 50,
        },
        "cpf": {
            cpf: true,
        },
        "endereco[logradouro]": {
            maxlength: 50
        },
        "endereco[numero]": {
            digits: true
        },
        "endereco[bairro]": {
            maxlength: 50
        },
        

    },

    messages: {}
})

jQuery.validator.addMethod("letras", function(value, element) {	
    return this.optional(element) || /^[a-záàâãéèêíïóôõöúçñ0-9 ]+$/i.test(value);	
}, 'Caracteres inválidos');	
jQuery.validator.addMethod("cpf", function(value, element) {	
    value = jQuery.trim(value);	

     value = value.replace('.', '');	
    value = value.replace('.', '');	
    cpf = value.replace('-', '');	
    while (cpf.length < 11) cpf = "0" + cpf;	
    var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;	
    var a = [];	
    var b = new Number;	
    var c = 11;	
    for (i = 0; i < 11; i++) {	
        a[i] = cpf.charAt(i);	
        if (i < 9) b += (a[i] * --c);	
    }	
    if ((x = b % 11) < 2) { a[9] = 0 } else { a[9] = 11 - x }	
    b = 0;	
    c = 11;	
    for (y = 0; y < 10; y++) b += (a[y] * c--);	
    if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11 - x; }	

     var retorno = true;	
    if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;	

     return this.optional(element) || retorno;	

 }, "Informe um CPF válido");	
</script>
@stop