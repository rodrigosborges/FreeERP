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
    
    //alterar a cidade quando precisar
    $(".estados").change()
})

$(document).on("change", ".tipo_telefones", function() {
    escolheMascaraTel($(this))
})

function escolheMascaraTel(element) {

    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    
    $(element).closest('.tel').find(".telefone").mask(SPMaskBehavior, spOptions);
}

//###########################

//ADICIONA E REMOVE DOCUMENTOS
$(document).on("click", ".add-doc", function() {
    if($(".doc").hasClass("d-none")) {
        $(".doc").removeClass("d-none")
        $(".documentos").hide().removeAttr('disabled').fadeIn("slow")
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
        $(".doc").last().find(".custom-file-label").html("Selecione");
        $(".file_download").remove()
    } else {
        remover(".doc", $(this))
    }
})

$(document).on('change', '.custom-file-input',function(e){
    var fileName = e.target.files[0].name
    $(this).parent().find(".custom-file-label").html(fileName);
})
//###########################

//ADICIONA E REMOVE DEPENDENTES
$(document).on("click", ".add-dep", function() {
    if($(".dep").hasClass("d-none")) {
        $(".dep").removeClass("d-none")
        $(".dependentes").hide().removeAttr('disabled').fadeIn()
    }
    else if($(".dep").length < 4) {
        clonar(".dep", "#dependentes", true)
        $(".dep").last().find(".dependentes").val("")
        $(".dep").last().find(".cpf").mask('000.000.000-00')
    } else {

        Swal.fire({
            type: 'warning',
            title: 'Atenção!',
            text: 'Podem ser adicionados no máximo '+$(".dep").length+' dependentes',
        })
 
    }
})

$(document).on("click", ".del-dep", function() {
    if($(".dep").length == 1) {
        $(".dep").last().find(".dependentes").val("")
        $('.dep').addClass('d-none')
        $(".dependentes").attr('disabled', 'disabled')
    } else {
        remover(".dep", $(this))
    }
})
//############################

//ENDEREÇO
$('.estados').change(function() {
    atualizarCidades($(".estados option:selected").data("uf"), $(".estados").data('cidade'))
    $(".estados").data('cidade','')
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
        if($(this).data("uf") == uf){
            $(this).attr('selected', 'selected')
        }
    })
}

function atualizarCidades(uf, selected_id = null) {
    $.ajax({
        url: main_url + "/funcionario/get-cidades/"+uf,
        type: 'GET',
        success: function(data){
            $(".cidades option").remove();
            $(".cidades").append("<option value=''>Selecione</option>")
            $.each(data, function(i, cidade) {
                $(".cidades").append(`<option ${selected_id == cidade.id ? 'selected' : ''} value=${cidade.id}>${cidade.nome}</option>`)
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

$('#cep').blur(function(){
    var cep = $(this).val().replace(/\D/g, '');
    if(cep != ""){
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
                    $(".bairro").val(dados.bairro);
                    atualizarCamposEndereco(dados)
                    $(".numero").focus()
                }
            })
        }else{
            Swal.fire({
                type: 'warning',
                title: 'Atenção!',
                text: 'Formato de CEP inválido!',
            })
        }
    }
});

//MÁSCARAS
$(".data").mask('00/00/0000')
$("#cep").mask('00000-000')
$("#numero").mask('99999')
$(".cpf").mask('000.000.000-00')