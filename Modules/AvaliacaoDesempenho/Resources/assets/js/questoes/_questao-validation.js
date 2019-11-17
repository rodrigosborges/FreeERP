$(document).ready(function (e) {

    $("#questaoForm").validate({
        rules: {
            'questao[enunciado]': { required: true },
            'questao[categoria_id]': { required: true },
            'questao[opt1]': { required: true },
            'questao[opt2]': { required: true },
            'questao[opt3]': { required: true },
            'questao[opt4]': { required: true },
            'questao[opt5]': { required: true }
        },

        messages: {
            'questao[enunciado]': { required: 'O campo Enunciado é obrigatório.' },
            'questao[categoria_id]': { required: 'O campo Categoria é obrigatório.' },
            'questao[opt1]': { required: 'O campo Opção 1 é obrigatório.' },
            'questao[opt2]': { required: 'O campo Opção 2 é obrigatório.' },
            'questao[opt3]': { required: 'O campo Opção 3 é obrigatório.' },
            'questao[opt4]': { required: 'O campo Opção 4 é obrigatorio.' },
            'questao[opt5]': { required: 'O campo Opção 5 é obrigatório.' }
        },

        errorPlacement: function (error, element) {
            if (element.hasClass('enunciado')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('categoria')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('opt1')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('opt2')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('opt3')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('opt4')) {
                error.appendTo(element.parents().siblings('.errors'))
            }

            if (element.hasClass('opt5')) {
                error.appendTo(element.parents().siblings('.errors'))
            }
        }
    })
})
