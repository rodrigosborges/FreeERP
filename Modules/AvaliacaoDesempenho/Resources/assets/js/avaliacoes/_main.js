$(document).ready(function () {

    const _token = $('#token').val()

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/avaliacao/ajax/search',
        data: {
            _token: _token,
            term: ''
        },
        success: function (data) {
            $('#AvaliacaoTable').append(data.html)
        }
    })
})

$(document).on('click', '#submit-btn', function (e) {

    e.preventDefault()
    
    const _token = $('input[name="_token"]').val()

    
    var search = {
        nome: $('input[name="_nome"]').val(),
        processo_id: $('#_processo').children('option:selected').val(),
        funcionario_id: $('#_responsavel').children('option:selected').val(),
        setor_id: $('#_setor').children('option:selected').val(),
        data_inicio: $('input[name="_data_inicio"]').val(),
        data_fim: $('input[name="_data_fim"]').val()
    }

    var status = $('#_status').children('option:selected').val()

    console.log(_token, search, status)

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/avaliacao/ajax/search',
        data: {
            _token: _token,
            term: search,
            status: status
        },
        success: function (data) {
            $('#AvaliacaoTable').html('')
            $('#AvaliacaoTable').append(data.html)
        }
    })
})

function confirmDelete(id, msg) {
    bootbox.confirm({
        message: msg,
        buttons: {
            confirm: {
                label: 'Sim',
                className: 'btn-success'
            },
            cancel: {
                label: 'Não',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            if (result == true)
                $('#deleteForm_'+id).submit()
        }
    });
}