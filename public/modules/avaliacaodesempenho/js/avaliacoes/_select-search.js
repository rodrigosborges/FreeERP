$(document).ready(function () {

    $('.select-questoes').on('keyup keydown', function () {
        var search = $(this).find("input").val()

        var select = $("#selectQuestoes")

        const _token = $('#token').val()

        if (search.length > 3) {
            $.ajax({
                method: 'POST',
                url: 'http://localhost/tcc/public/avaliacaodesempenho/ajax/field',
                data: {
                    _token: _token,
                    table: 'questao',
                    parameter: search
                },
                dataType: 'JSON',
                success: function (data) {
                    select.empty()

                    $.each(data, function (i, val) {
                        select.append($('<option></option>').val(val.id).html(`Enunciado: ${val.enunciado} | Categoria: ${val.categoria.nome}`))
                    })

                    $('.selectpicker').selectpicker('refresh')

                    $('.dropdown-item').on('click', function(e) {
                        
                        var id = $('#selectQuestoes').val()
                        
                        $('#questaoCard').removeClass('hidden')   
                        
                        populateCard(id, _token)
                    })
                }
            })
        } else {
            select.empty()
            $('.selectpicker').selectpicker('refresh')
        }
    })
})

function populateCard(id, _token) {
    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/ajax/field',
        data: {
            _token: _token,
            table: 'questao',
            id: id
        },
        dataType: 'JSON',
        success: function (data) {
            $(".save-card").attr("onclick","salvarQuestao("+ data[0].id +", '"+ data[0].enunciado +"')");
            $('#questaoCard .card-header').html(`<b>Categoria: ${data[0].categoria.nome}</b>`)
            $('#questaoCard .card-body .enunciado').html(`<b>Enunciado: <p> ${data[0].enunciado} </p></b>`)
            $('#questaoCard .card-body .options').prepend(`<b>Alternativas: </b>`)
            $('#questaoCard .card-body .options ul').append(`<li> a) - ${data[0].opt1} </li>`)
            $('#questaoCard .card-body .options ul').append(`<li> b) - ${data[0].opt2} </li>`)
            $('#questaoCard .card-body .options ul').append(`<li> c) - ${data[0].opt3} </li>`)
            $('#questaoCard .card-body .options ul').append(`<li> d) - ${data[0].opt4} </li>`)
            $('#questaoCard .card-body .options ul').append(`<li> e) - ${data[0].opt5} </li>`)
        }
    })
}

function salvarQuestao(id,enunciado) {
    console.log(id);
    console.log(enunciado);
}