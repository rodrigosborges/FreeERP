$(document).ready(function() {

    $('#table').DataTable({
        'searching': false,
        'lengthChange': false,
        'ordering': false,
        "pageLength": 2,
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

    $('.avaliar').on('click', function(e) {
        e.preventDefault()

        var id = $(this).attr('id')

        $('.questoes').removeClass('invisible')

        $('#funcionarioId').val(id)    
    })
})

