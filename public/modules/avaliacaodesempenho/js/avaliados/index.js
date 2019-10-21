$(document).ready(function() {

    $('.avaliar').on('click', function(e) {
        e.preventDefault()

        var id = $(this).attr('id')

        $('.questoes').removeClass('invisible')

        $('#funcionarioId').val(id)    
    })
})