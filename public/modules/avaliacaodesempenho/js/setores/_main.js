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
            $('#table').DataTable({
                'searching': false,
                'lengthChange': false,
                "pageLength": 5,
                "language": {
                    "zeroRecords": '<div style="color: red">Não foram encontrados registros.</div>',
                    "emptyTable": '<div style="color: red">Não foram encontrados registros.</div>',
                    "info": "Exibindo _START_ a _END_ de _TOTAL_ registros no total",                    
                    "infoEmpty": "",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Proxima",
                        "last": "Ultima",
                    }
                }
            })
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
            $('#table').DataTable({
                'searching': false,
                'lengthChange': false,
                "pageLength": 5,
                "language": {
                    "zeroRecords": '<div style="color: red">Não foram encontrados registros.</div>',
                    "emptyTable": '<div style="color: red">Não foram encontrados registros.</div>',
                    "info": "Exibindo _START_ a _END_ de _TOTAL_ registros no total",                    
                    "infoEmpty": "",
                    "paginate": {
                        "previous": "Anterior",
                        "next": "Proxima",
                        "last": "Ultima",
                    }
                }
            })
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