$(document).ready(function() {

    $('.avaliar').on('click', function(e) {
        e.preventDefault()

        console.log($(this).attr('id'))
        console.log($(this).parent().siblings())

        // $('#funcionarioId')
    })
})