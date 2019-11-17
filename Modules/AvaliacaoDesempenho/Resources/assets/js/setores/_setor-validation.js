$(document).ready(function (e) {

    $("#setorForm").validate({
        rules: {
            'setor[nome]': { required: true },
            'setor[gestor_id]': { required: true }
        },

        messages: {
            'setor[nome]': { required: 'O campo Nome é obrigatório.' },
            'setor[gestor_id]': { required: 'O campo Gestor é obrigatório.' }
        },

        errorPlacement: function (error, element) {
            if (element.hasClass('nome')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('gestor')) {
                error.appendTo(element.parents().siblings('.errors'))
            }
        }
    })
})
