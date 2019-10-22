$(document).on('keydown keyup paste', '.select-questoes', function (e) {
    var search = $(this).find("input").val()

    var select = $("#selectQuestoes")

    const _token = $('#token').val()

    if (search.length > 3) {
        $.ajax({
            method: 'GET',
            url: 'http://localhost/tcc/public/avaliacaodesempenho/ajax/field',
            data: { 
                _token: _token,
                table: 'questao',
                parameter: search
            },
            dataType: 'JSON',
            success: function (data) {
                console.log(data.length)
                select.empty()

                $.each(data, function (i, val) {
                    select.append($('<option></option>').val(val.id).html(`Enunciado: ${val.enunciado} | Categoria: ${val.categoria.nome}`))
                })

                $('.selectpicker').selectpicker('refresh')

                if (select.val()) {

                    $('#questaoCard').removeClass('hidden')

                    $('.card-header').html(`<p>Categoria: ${val.categoria.nome} </p>`)
                    $('.card-body').append(`<p>Enunciado: ${val.enunciado} </p><hr>`)
                    $('.card-body').append(`<p>Alternativas: </p>`)
                    $('.card-body').append(`<ul> <li> a) - ${val.opt1} </li> <li> b) - ${val.opt2}</li> <li> c) - ${val.opt3} </li> <li> d) - ${val.opt4} </li> <li> e) - ${val.opt5} </li> </ul>`)
                }
            }
        })
    } else {
        select.empty()
        $('.selectpicker').selectpicker('refresh')
    }
})