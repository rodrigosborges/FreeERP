$(document).ready(function () {

    const _token = $('#token').val()

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/ajax/search',
        data: {
            _token: _token,
            table: 'setores',
            term: ''
        },
        success: function (data) {
            $('#SetorTable').append(data)
        }
    })
})

$(document).on('click', '#submit-btn', function (e) {

    e.preventDefault()
    
    const _token = $('input[name="_token"]').val()
    var search = {
        nome: $('input[name="_nome"]').val()
    }
    var status = $('#_status').children('option:selected').val()

    console.log(_token, search, status)

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/ajax/search',
        data: {
            _token: _token,
            table: 'setores',
            term: search,
            status: status
        },
        success: function (data) {
            $('#SetorTable').html('')
            $('#SetorTable').append(data)
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