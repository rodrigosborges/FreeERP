$(document).ready(function (e) {

    $("#avaliacaoForm").validate({
        rules: {
            'avaliacao[nome]': { required: true },
            'avaliacao[data_inicio]': { required: true },
            'avaliacao[data_fim]': { required: true },
            'avaliacao[processo_id]': { required: true },
            'avaliacao[funcionario_id]': { required: true },
            'avaliacao[setor_id]': { required: true },
            'avaliacao[tipo_id]': { required: true }
        },

        messages: {
            'avaliacao[nome]': { required: 'O campo Nome é obrigatório.' },
            'avaliacao[data_inicio]': { required: 'O campo Data Inicio é obrigatório.' },
            'avaliacao[data_fim]': { required: 'O campo Data Fim é obrigatório.' },
            'avaliacao[processo_id]': { required: 'O campo Processo é obrigatório.' },
            'avaliacao[funcionario_id]': { required: 'O campo Responsável é obrigatório.' },
            'avaliacao[setor_id]': { required: 'O campo Setor é obrigatorio.' },
            'avaliacao[tipo_id]': { required: 'O campo Tipo de Avaliação é obrigatório.' }
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

            if (element.hasClass('processo')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('responsavel')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('setor')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('tipo')) {
                error.appendTo(element.parents().siblings('.errors'))
            }
        }
    })
})
