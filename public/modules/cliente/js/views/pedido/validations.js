$('#form').validate({
    rules: {
       "data":{
            date: true,
            maxlength: 10,
            dataBR: true
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
jQuery.validator.addMethod("dataBR", function (value, element) {
    //contando chars
    if (value.length != 10) return (this.optional(element) || false);
    // verificando data
    var data = new Date();
    var anoAtual = data.getYear();
    var mesAtual = data.getMonth() + 1;
    var diaAtual = data.getDate();
    if (anoAtual < 1000){
      anoAtual+=1900;
    }
  
    var data = value;
    var dia = data.substr(0, 2);
    var barra1 = data.substr(2, 1);
    var mes = data.substr(3, 2);
    var barra2 = data.substr(5, 1);
    var ano = data.substr(6, 4);
    if (data.length != 10 || barra1 != "/" || barra2 != "/" || isNaN(dia) || isNaN(mes) || isNaN(ano) || dia > 31 || mes > 12) return (this.optional(element) || false);
    if ((mes == 4 || mes == 6 || mes == 9 || mes == 11) && dia == 31) return (this.optional(element) || false);
    if (mes == 2 && (dia > 29 || (dia == 29 && ano % 4 != 0))) return (this.optional(element) || false);
    if (ano < 1900 || ano > anoAtual) return (this.optional(element) || false);
    if (ano >= anoAtual && mes > mesAtual) return (this.optional(element) || false);
    if ((ano >= anoAtual && dia > diaAtual) && (mes >= mesAtual && dia > diaAtual)) return (this.optional(element) || false);
  
    return (this.optional(element) || true);
  }, "Informe uma data válida.");  // Mensagem padrão