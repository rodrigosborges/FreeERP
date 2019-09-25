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
       "produtos[][produto_id]":{
            digits: true
        },
        "produtos[][quantidade]":{
            digits: true,
            maxlength: 3
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
    var mesAtual = '' + (hoje.getMonth() + 1)
    var diaAtual = '' + hoje.getDate()
    var anoAtual = hoje.getFullYear()

    var data = value;
    var dia = data.substr(0, 2);
    var barra1 = data.substr(2, 1);
    var mes = data.substr(3, 2);
    var barra2 = data.substr(5, 1);
    var ano = data.substr(6, 4);

    if(anoAtual < ano)                                          return (this.optional(element) || false);
    if(anoAtual >= ano && mesAtual < mes)                       return (this.optional(element) || false);
    if(anoAtual >= ano && mesAtual >= mes && diaAtual < dia)    return (this.optional(element) || false);
    
    return (this.optional(element) || true);


  }, "Informe uma data anterior ao dia de hoje.");  // Mensagem padrão
  