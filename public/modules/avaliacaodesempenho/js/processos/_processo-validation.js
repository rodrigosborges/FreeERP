$(document).ready(function (e) {

    $("#processoForm").validate({
        rules: {
            'processo[nome]': { required: true },
            'processo[data_inicio]': { required: true },
            'processo[data_fim]': { required: true },
            'processo[funcionario_id]': { required: true }
        },

        messages: {
            'processo[nome]': { required: 'O campo Nome é obrigatório.' },
            'processo[data_inicio]': { required: 'O campo Data Inicio é obrigatório.' },
            'processo[data_fim]': { required: 'O campo Data Fim é obrigatório.' },
            'processo[funcionario_id]': { required: 'O campo Responsável é obrigatório.' }
        },

        errorPlacement: function (error, element) {
            if (element.hasClass('nome')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('data_inicio')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('data_fim')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('responsavel')) {
                error.appendTo(element.parents().siblings('.errors'))
            }
        }
    })
})
