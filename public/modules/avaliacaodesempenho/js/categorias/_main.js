$(document).ready(function () {

    const _token = $('#token').val()

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/categoria/ajax/search',
        data: {
            _token: _token,
            term: ''
        },
        success: function (data) {
            $('#CategoriaTable').append(data.html)
        }
    })
})

$(document).on('keyup keydown paste', '.search_field', function () {

    var search = $(this).val()
    const _token = $('#token').val()

    if (search.length < 1 || search.length > 2) {

        $.ajax({
            method: 'POST',
            url: 'http://localhost/tcc/public/avaliacaodesempenho/categoria/ajax/search',
            data: {
                _token: _token,
                term: search
            },
            success: function (data) {
                $('#CategoriaTable').html('')
                $('#CategoriaTable').append(data)
            }
        })
    }
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