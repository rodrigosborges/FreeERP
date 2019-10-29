$(document).ready(function(e) {
    var total;
    
    $('.adicional1').blur(function() {
        var adicional = parseFloat($('.adicional1').val())
        total = (parseFloat($('#total').val())) + adicional
        alert(total)

    })
    // quando tirado o foco do select de funcionario ele dispara a função
    //a função faz uma requisição ajax para a pagina buscaCargos
    // autor: Denise Lopes
    $('#funcionario').change(function() {
        buscaFuncionario()
    })
    // select de cargo
    // autor: Denise Lopes
    $('#cargos').change(function() {
        buscaSalario()
    })
    $('#opcao-pagamento').change(function() {
        opcaoPagamento()
    })
  
})
// autor: Denise Lopes
function opcaoPagamento() {
    if ($('#opcao-pagamento').val() != 1) {
        $('#valor').val('')
        $('#inss').val('')
        $('#total').val('')
    } else {
        buscaSalario()
    }
}
function buscaSalario() {
    $.ajax({
        url: main_url + "/buscasalario",
        datatype: 'json',
        type: 'post',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#cargos').val()
        }
        //data é igual a salário
    }).done(function(data) {
        console.log(data)
        var salario;

        if (data != null && data != "") {
            var salario = parseFloat(data)

            formula = (salario * 8) / 100;
            // Aliquota minima 
            $('#valor').val(salario)
            if (salario <= 1751.81) {
                inss = formula;

            } else if (data > 1751.81) {
                inss = formula;

            } else {
                inss = formula;
            }
            total = salario - inss;
            $('#total').val(total)
            console.log("inss:" + inss + "salario:" + data)
            $('#inss').val(inss);
        } else {

            $('#valor').val("")
            $('#inss').val("")
            $('#total').val("")

        }
        console.log("Data:" + data)
        //  
    }).fail(function() {

    })
}
function buscaFuncionario() {
    $.ajax({
        url: main_url + "/buscacargos",
        datatype: 'json',
        type: 'post',
        data: {
            '_token': $('input[name=_token]').val(),
            'id': $('#funcionario').val()
        }
    }).done(function(data) {
        //após capturar os cargos ele faz um foreach nos cargos e adiciona em uma string 
        // que posteriormente é enviada para o select de cargos
        var cargos = $.parseJSON(data);
        string = " <option value='0'>Selecione</option>"
        $.each(cargos, function(chave, valor) {
            string += '<option value="' + valor.id + '">' + valor.nome + "</option>"
        })

        $('#cargos').html(string);
    }).fail(function() {})
}