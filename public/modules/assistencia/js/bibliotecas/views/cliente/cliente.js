$('#form').validate({
    rules: {
        "nome": {
            letras : true,
            maxlength: 100,
        },
        "cpf": {
            cpf: true,
        },
        "email": {
            maxlength: 50,
        },
        "data_nascimento": {
            maxlength: 10
        },
        "celnumero": {
           
            maxlength: 15
        },
        "telefonenumero": {
            maxlength: 15
        },
        "endereco[logradouro]":{
            maxlength: 50
        },
        "endereco[numero]": {
            digits: true,
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
 $(document).ready(function() {

    if($('[name="endereco[estado_id]"]').val()){
        console.log($('[name="endereco[estado_id]"]').val())
        getCidades($('[name="endereco[estado_id]"]').val(), $('[name="endereco[estado_id]"]').attr('cidade'))
    }

    $('.cpf-mask').mask("000.000.000-00")
    $('.cep').mask("00000-000")

        
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

$('#estado').change(function() {

    var idEstado = $(this).val();
    console.log(idEstado)
    if (idEstado) {
        getCidades(idEstado);
    } else {
        $('#cidade').empty()
        $('#cidade').append("<option value=''>Selecione</option>")
    }

});
function getCidades(estado_id,nome_cidade=null){
   
    $.get(main_url+'/api/assistencia/cidades/' + estado_id, function(cidades) {
            $('#cidade').empty()
            $('#cidade').append("<option value=''>Selecione</option>")
            $.each(cidades, function(key, value) {
               
                if(nome_cidade == value.nome || nome_cidade == value.id){
                    $('#cidade').append('<option selected value=' + value.id + '>' + value.nome + '</option>')
                }else{
                    $('#cidade').append('<option  value=' + value.id + '>' + value.nome + '</option>')
                }
            })
    })

}