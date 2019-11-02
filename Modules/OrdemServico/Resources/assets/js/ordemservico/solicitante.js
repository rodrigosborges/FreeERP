$(document).ready(function () {

    // Quando o formulario é retornado com algum erro definir mascara de cpf ou cpnj 
    if($(".identificacao").val().length == 14){
        $(".identificacao").mask('00.000.000/0000-00');
    }
    else{
        $(".identificacao").mask('000.000.000-00#');
    }

    //Alterar mascara de cpf para cnpj se for necessário
    $('.identificacao').keyup(function () {
        if( $(this).val().length > 15 ) {
            $(this).mask('00.000.000/0000-00');
        }
    });

    $(".btn-success").click(function () {
        $('.identificacao').unmask();
    });

    //função que habilita edição para campos que poderão ser editados 
    $("input[name='solicitante[email]'").dblclick(function () {
        $(this).removeAttr('readonly');
    });

    //Se já existir um solicitante com essa identificação autocompletar campos associados ao solicitante
    $("input[name='solicitante[id]'").blur(function () {
        $.getJSON("/ordemservico/solicitante/showSolicitante", {
            identificacao: $(this).cleanVal()
        }).done(function (data) {
            $("input[name='solicitante[nome]'").val(data.solicitante.nome).prop('readonly', true);
            $("input[name='solicitante[email]'").val(data.solicitante.email).prop('readonly', true);
            $("input[name='endereco[cep]'").val(data.endereco.cep).prop('readonly', true).mask('00000-000');
            $("input[name='endereco[rua]'").val(data.endereco.rua).prop('readonly', true);
            $("#localidade").val(data.endereco.cidade_id).attr("readonly", "true");
            $("#uf").val(data.endereco.estado_id).attr("readonly", "true");
            $("input[name='endereco[bairro]'").val(data.endereco.bairro).prop('readonly', true);
            $("input[name='endereco[numero]'").val(data.endereco.numero).prop('readonly', true);
            $("input[name='endereco[complemento]'").val(data.endereco.complemento).prop('readonly', true);

            $primeiroCampoTel = $('.telefones').find('.form-inline').first().find('input');
            data.telefones.forEach(telefone => {
                if ($primeiroCampoTel.val() == "") {
                    $('.telefones').find('.form-inline').first().find('input').val(telefone.numero).prop('readonly', true);
                }
                else {
                    var div = $('.telefones').find('.form-inline').first().clone(true);
                    div.find('input').val('').mask('(99) 99999-9999').val(telefone.numero).prop('readonly', true);
                    $('.telefones').append(div);
                }
            });

        }).fail(function () {
            $("input[name='solicitante[nome]'").val("").prop('readonly', false);
            $("input[name='solicitante[email]'").val("").prop('readonly', false);
            $("input[name='endereco[cep]'").val("").prop('readonly', false).mask('00000-000');
            $("input[name='endereco[rua]'").val("").prop('readonly', false);
            $("#localidade").removeAttr('readonly');
            $("#uf").removeAttr("readonly");
            $("input[name='endereco[bairro]'").val("").prop('readonly', false);
            $("input[name='endereco[numero]'").val("").prop('readonly', false);
            $("input[name='endereco[complemento]'").val("").prop('readonly', false);
            $("input[name='telefone[][numero]'").val("").prop('readonly', false);
        })
    });

});