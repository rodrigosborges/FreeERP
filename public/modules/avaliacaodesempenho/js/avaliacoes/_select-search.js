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

function salvarQuestao(id,enunciado) {
    $('<input>').attr({
        type: 'hidden',
        name: 'avaliacao[questoes][]',
        value: id
    }).appendTo('#avaliacaoForm')
    
    $('#questaoCard').html('')
    $('select').val('').selectpicker('refresh')
}