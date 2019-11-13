$(document).on('keyup keydown paste', '.select-questoes', function () {

    var search = $(this).find("input").val()

    var select = $("#selectQuestoes")

    const _token = $('#token').val()

    if (search.length > 2) {
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

                var incluidas = []

                $('.inputQuestao').each(function (e) {
                    incluidas.push(parseInt($(this).val()))
                })

                $.each(data, function (i, val) {
                    if (!incluidas.includes(val.id)) {
                        select.append($('<option></option>').val(val.id).html(`Enunciado: ${val.enunciado} | Categoria: ${val.categoria.nome}`))
                    }
                })
                
                $('.selectpicker').selectpicker('refresh')
                
                $('.dropdown-item').on('click', function (e) {

                    var id = $('#selectQuestoes option:selected').val()

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

            $('#questaoCard').html(`
                
                <div class='card'>
                
                    <div class='card-header'>
                        <b>Categoria: ${data[0].categoria.nome}</b>
                    </div>

                    <div class='card-body'>
                        <b>Enunciado: ${data[0].enunciado}</b>
                        <br>
                        <b>Alternativas:</b>
                        <ul class='alternativas'>
                            <li>a) - ${data[0].opt1}</li>
                            <li>b) - ${data[0].opt2}</li>
                            <li>c) - ${data[0].opt3}</li>
                            <li>d) - ${data[0].opt4}</li>
                            <li>e) - ${data[0].opt5}</li>
                        </ul>
                    </div>

                    <div class='card-footer'>
                        <button type='button' class='btn btn-primary btn-sm float-right save-card' onclick='salvarQuestao(${data[0].id},"${data[0].enunciado}")'>Salvar</button>
                    </div>

                </div>
            `)
        }
    })
}

function salvarQuestao(id, enunciado) {
    $('<input>').attr({
        type: 'hidden',
        class: 'inputQuestao',
        name: 'avaliacao[questoes][]',
        value: id
    }).appendTo('#avaliacaoForm')

    $('.selectpicker').empty()

    $('.selectpicker').selectpicker('refresh')

    $('#questaoCard').html('')
    $('select').val('').selectpicker('refresh')
}