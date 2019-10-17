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

                if (data.length === 1) {

                    $('#questaoCard').removeClass('hidden')

                    $('.card-header').html('<p>Categoria: </p>')
                }
            }
        })
    } else {
        select.empty()
        $('.selectpicker').selectpicker('refresh')
    }
})