$(document).ready(function () {

    const _token = $('#token').val()

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/ajax/search',
        data: {
            _token: _token,
            table: 'processos',
            term: ''
        },
        success: function (data) {
            $('#ProcessoTable').append(data)
            $('#table').DataTable({
                'searching': false,
                'lengthChange': false,
                "pageLength": 5,
                "language": {
                    "zeroRecords": "Não foram encontrados resultados",
                    "emptyTable": "Não foram encontrados resultados",
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
        nome: $('input[name="_nome"]').val(),
        funcionario_id: $('#_responsavel').children('option:selected').val(),
        data_inicio: $('input[name="_data_inicio"]').val(),
        data_fim: $('input[name="_data_fim"]').val()
    }

    var status = $('#_status').children('option:selected').val()

    console.log(_token, search, status)

    $.ajax({
        method: 'POST',
        url: 'http://localhost/tcc/public/avaliacaodesempenho/ajax/search',
        data: {
            _token: _token,
            table: 'processos',
            term: search,
            status: status
        },
        success: function (data) {
            $('#ProcessoTable').html('')
            $('#ProcessoTable').append(data)
            $('#table').DataTable({
                'searching': false,
                'lengthChange': false,
                "pageLength": 5,
                "language": {
                    "zeroRecords": "Não foram encontrados resultados",
                    "emptyTable": "Não foram encontrados resultados",
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