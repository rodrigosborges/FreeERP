//ADICIONA E REMOVE TELEFONES
$(document).on("click", ".add-tel", function() {
    if($(".tel").length < 4) {
        clonar(".tel", "#telefones", true)
        $(".tel").last().find("input").val("")
        $(".tel").last().find("select").val("")
    } else {
        Swal.fire({
            type: 'warning',
            title: 'Atenção!',
            text: 'Podem ser adicionados no máximo '+$(".tel").length+' telefones',
        })
    }
})

$(document).on("click", ".del-tel", function() {
    if($(".tel").length > 1) {
        remover(".tel", $(this))
    } else {

        Swal.fire({
            type: 'warning',
            title: 'Atenção!',
            text: 'Deve conter no mínimo 1 telefone!',
        })
    }
})

//MUDA A MÁSCARA DO TELEFONE
$(document).ready(function(){
    $(".tipo_telefones").each(function(){
        escolheMascaraTel($(this))
    })
})

$(document).on("change", ".tipo_telefones", function() {
    escolheMascaraTel($(this))
})

function escolheMascaraTel(element) {
    console.log($(element).find('option:selected').val())
    if($(element).find('option:selected').val() == 1) {
        $(element).closest('.tel').find(".telefone").mask('(00) 0000-0000')
    } else {
        $(element).closest('.tel').find(".telefone").mask('(00) 00000-0000')
    }
}

//###########################

//ADICIONA E REMOVE DOCUMENTOS
$(document).on("click", ".add-doc", function() {
    if($(".doc").hasClass("d-none")) {
        $(".doc").removeClass("d-none")
        $(".documentos").removeAttr('disabled')
    }
    else if($(".doc").length < 4) {
        clonar(".doc", "#documentos", true)
        $(".doc").last().find(".documentos").val("")
    } else {

        Swal.fire({
            type: 'warning',
            title: 'Atenção!',
            text: 'Podem ser adicionados no máximo '+$(".doc").length+' documentos',
        })
 
    }
})

$(document).on("click", ".del-doc", function() {
    if($(".doc").length == 1) {
        $(".doc").last().find(".documentos").val("")
        $('.doc').addClass('d-none')
        $(".documentos").attr('disabled', 'disabled')
    } else {
        remover(".doc", $(this))
    }
})
//###########################

//ENDEREÇO
$('.estados').change(function() {
    $(".estados option").each(function() {
        if($(this).is(':selected')){
            atualizarCidades($(this).text())
        }
    })
})

function atualizarCamposEndereco(dados) {
    selecionarEstado(dados.uf)

    $.ajax({
        url: main_url + "/funcionario/get-cidades/"+dados.uf,
        type: 'GET',
        success: function(data){
            $(".cidades option").remove();
            $(".cidades").append("<option value=''>Selecione</option>")
            $.each(data, function(i, cidade) {
                $(".cidades").append("<option value="+cidade.id+">"+cidade.nome+"</option>")
            })
            selecionarCidade(dados.localidade)
        },
        error: function() {
            //CEP pesquisado não foi encontrado.
            limpa_formulario_cep();
            Swal.fire({
                type: 'warning',
                title: 'Desculpe...',
                text: 'CEP não encontrado!',
            })
        }
    })
}

function selecionarEstado(uf) {
    $(".estados option").removeAttr('selected')
    $(".estados option").each(function() {
        if($(this).text() == uf){
            $(this).attr('selected', 'selected')
        }
    })
}

function atualizarCidades(uf) {
    $.ajax({
        url: main_url + "/funcionario/get-cidades/"+uf,
        type: 'GET',
        success: function(data){
            $(".cidades option").remove();
            $(".cidades").append("<option value=''>Selecione</option>")
            $.each(data, function(i, cidade) {
                $(".cidades").append("<option value="+cidade.id+">"+cidade.nome+"</option>")
            })
        }
    })
}

function selecionarCidade(cidade) {
    $(".cidades option").removeAttr('selected')
    $(".cidades option").each(function() {
        if($(this).text() == cidade){
            $(this).attr("selected", "selected")
        }
    })

}

//BUSCA CEP
function limpa_formulario_cep(){
    $('.logradouro').val('');
}

$('#cep').blur(function(){
    var cep = $(this).val().replace(/\D/g, '');
    if(cep !=""){
     var validacep = /^[0-9]{8}$/;   
     if(validacep.test(cep)) {
        $('.logradouro').val('...');

        $.ajax({
            url: "https://viacep.com.br/ws/"+ cep +"/json/",
            type: 'GET',
            dataType: "json",
            success: function(dados){
                //Atualiza os campos com os valores da consulta.
                $(".logradouro").val(dados.logradouro);
                atualizarCamposEndereco(dados)
            }
        })

        }else{
            limpa_formulario_cep();
            Swal.fire({
                type: 'warning',
                title: 'Atenção!',
                text: 'Formato de CEP inválido!',
            })
        }
    }else{
        limpa_formulario_cep();
    }
});

//MÁSCARAS
$(".data").mask('00/00/0000')
$("#cep").mask('00000-000')
$("#numero").mask('99999')
$("#cpf").mask('000.000.000-00')