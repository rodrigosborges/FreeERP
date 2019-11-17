$(document).ready(function (e) {

    $("#categoriaForm").validate({
        rules: {
            'categoria[nome]': { required: true }
        },

        messages: {
            'categoria[nome]': { required: 'O campo Nome é obrigatório.' }
        },

        errorPlacement: function (error, element) {
            if (element.hasClass('nome')) {
                error.appendTo(element.parents().siblings('.errors'))
            }
        }
    })
})
