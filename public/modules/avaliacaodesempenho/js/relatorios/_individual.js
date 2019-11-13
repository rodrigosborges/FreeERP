$(document).ready(function() {

    $('#_processo').change(function(e) {

        const _token = $('#token').val()
        var processo_id = $(this).val()

        if (processo_id !== '') {

            $.ajax({
                method: 'POST',
                url: 'http://localhost/tcc/public/avaliacaodesempenho/relatorio/avaliacoes',
                data: {
                    _token: _token,
                    id: processo_id
                },
                success: function (data) {
                    $('#_avaliacao').html('')
                    $('#_avaliacao').attr('disabled', false)
                    $('#submit-btn').attr('disabled', false)
    
                    data.forEach(avaliacao => {
                        var tipo = avaliacao.tipo_id === 1 ? 'Avaliar Funcionarios' : 'Avaliar Gestor'
                        $('#_avaliacao').append(`
                            <option value='${avaliacao.id}'>${avaliacao.nome} | ${tipo} </option>
                        `)
                    });
                }
            })

        } else {
            $('#_avaliacao').html('')
            $('#_avaliacao').attr('disabled', true)
            $('#submit-btn').attr('disabled', true)
        }
    })

    $('#submit-btn').on('click', function() {
        const _token = $('#token').val()
        var avaliacao_id = $('#_avaliacao').val()

        $.ajax({
            method: 'POST',
            url: 'http://localhost/tcc/public/avaliacaodesempenho/relatorio/individual',
            data: {
                _token: _token,
                avaliacao: avaliacao_id
            },
            success: function (data) {
                $('#RelatorioIndividualListar').html('')
                $('#RelatorioIndividualListar').append(data)
                $('.initial-info').css('display', 'none')

                $('#table').DataTable({
                    'searching': false,
                    'lengthChange': false,
                    "pageLength": 10,
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
})

function visualizarGeral(e) {
    console.log('ashbdaskdbaskdjbas')
    $('.gestor').removeClass('hidden')
}