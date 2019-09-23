$(document).ready(function () {

    const _token = $('#token').val()

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/processo/ajax/search',
        data: {
            _token: _token,
            term: ''
        },
        success: function (data) {
            $('#ProcessoTable').append(data.html)
        }
    })
})

$(document).on('keyup keydown paste', '.search_field', function () {

    var search = $(this).val()
    const _token = $('#token').val()

    if (search.length < 1 || search.length > 2) {

        $.ajax({
            method: 'POST',
            url: 'http://localhost/tcc/public/avaliacaodesempenho/processo/ajax/search',
            data: {
                _token: _token,
                term: search
            },
            success: function (data) {
                $('#ProcessoTable').html('')
                $('#ProcessoTable').append(data)
            }
        })
    }
})

function confirmDelete(msg) {
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
                $('#deleteForm').submit()
                // window.location.href = 'http://localhost/tcc/public/avaliacaodesempenho/processos/' + funcao + '/' + id;
        }
    });
}