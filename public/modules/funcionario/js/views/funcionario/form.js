$(document).ready(function() {
    //ADICIONA E REMOVE TELEFONES
    $(document).on("click", ".add-tel", function() {
        if($(".tel").length < 4) {
            $(".tel").last().clone().appendTo("#telefones")
            $(".telefones").last().val('')
            $(".tel").last().find('label').remove()
            //mascararTel(".telefones")
        } else { 
            alert("Número máximo de telefones permitidos atingido!")
        }
    })

    const numerosRemovidos = []

    $(document).on("click", ".del-tel", function() {
        if($(".tel").length > 1) {
            numerosRemovidos.push($(this).closest(".tel").attr('id'))
            $(this).closest(".tel").remove()
            $(".add-tel").last().show()
        } else {
            Swal.fire({
                type: 'warning',
                title: 'Atenção!',
                text: 'O indivíduo deve ter pelo menos um telefone!',
            })
        }
        $("#numeros_removidos").val(numerosRemovidos)
    })
    //###########################
})