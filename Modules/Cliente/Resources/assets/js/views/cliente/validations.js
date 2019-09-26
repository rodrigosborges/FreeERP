$('#form').validate({
    rules: {
        "cliente[nome]": {
            letras : true,
            maxlength: 100,
        },
        "cliente[nome_fantasia]": {
            maxlength: 100,
        },
        "email[email]": {
            maxlength: 50,
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

 jQuery.validator.addMethod("cnpj", function(value, element) {	
    var b = [6,5,4,3,2,9,8,7,6,5,4,3,2], c = value;	
    var retorno = true;	
    if((c = c.replace(/[^\d]/g,"").split("")).length != 14)	
        retorno =  false;	
    for (var i = 0, n = 0; i < 12; n += c[i] * b[++i]); 	
    if(c[12] != (((n %= 11) < 2) ? 0 : 11 - n))	
        retorno = false; 	
    for (var i = 0, n = 0; i <= 12; n += c[i] * b[i++]); 	
    if(c[13] != (((n %= 11) < 2) ? 0 : 11 - n))	
        retorno = false;  	
    return this.optional(element) || retorno;	

 }, "Informe um CNPJ válido");