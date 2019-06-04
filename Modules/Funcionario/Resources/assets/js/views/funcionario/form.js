//ADICIONA E REMOVE TELEFONES
$(document).on("click", ".add-tel", function() {
    if($(".tel").length < 4) {
        clonar(".tel", "#telefones", true)
        $(".tel").last().find("input").val("")
        $(".tel").last().find("input").mask('(00) 0000-0000')
    } else {
        alert('Podem ser adicionados no máximo '+$(".tel").length+' telefones')
    }
})

$(document).on("click", ".del-tel", function() {
    if($(".tel").length > 1) {
        remover(".tel", $(this))
    } else {
        alert('Deve conter no mínimo 1 telefone')
    }
})
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
        alert('Podem ser adicionados no máximo '+$(".doc").length+' documentos')
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

//MÁSCARAS
$(".data").mask('00/00/0000')
$("#cep").mask('00000-000')
$("#numero").mask('99999')
$("#cpf").mask('000.000.000-00')
$(".telefone").mask('(00) 0000-0000')