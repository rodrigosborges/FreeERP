$('#form').validate({
    rules: {
       "data":{
            date: true,
            maxlength: 10,
            dataAteHoje: true
       },
       "numero":{
            digits: true,
            maxlength:50
       },
       "produtos[0][produto_id]":{
            digits: true
        },
        "produtos[0][quantidade]":{
            digits: true,
        }
    },

    messages: {}
})


jQuery.extend(jQuery.validator.methods, {
    date: function (value, element) {
        return this.optional(element) || /^\d\d?\/\d\d?\/\d\d\d?\d?$/.test(value);
    },
    number: function (value, element) {
        return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:\.\d{3})+)(?:,\d+)?$/.test(value);
    }
});

jQuery.validator.addMethod("dataAteHoje", function (value, element) {
    var hoje = new Date()
    var mesAtual = hoje.getMonth() + 1
    var diaAtual = hoje.getDate()
    var anoAtual = hoje.getFullYear()

    var data = value;
    var dia = parseInt(data.substr(0, 2));
    var barra1 = parseInt(data.substr(2, 1));
    var mes = parseInt(data.substr(3, 2));
    var barra2 = parseInt(data.substr(5, 1));
    var ano = parseInt(data.substr(6, 4));

    if(ano > anoAtual)                                          return (this.optional(element) || false);
    if(ano == anoAtual && mes > mesAtual)                       return (this.optional(element) || false);
    if(ano == anoAtual && mes == mesAtual && dia > diaAtual)    return (this.optional(element) || false);
    
    return (this.optional(element) || true);


  }, "Informe uma data anterior ao dia de hoje.");  // Mensagem padrão
  