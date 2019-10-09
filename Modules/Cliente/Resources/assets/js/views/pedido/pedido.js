$(document).on('click', '#adicionar-produto', function () {

    $('.excluir-produto').parent().removeClass('d-none');
    var pedido = $(".produto").last().clone();

    pedido.find('.error').remove();
    pedido.find('.has-error').removeClass('has-error')

    var inputs = pedido.find('select, input');
    inputs.val("");
    inputs.map((i, input) => {
        var match = $(input).attr('name').match(/\[(\d+)]/g)[0]
        var contador = parseInt(match.replace('[', '').replace(']', '')) + 1
        var newName = $(input).attr('name').replace(match, `[${contador}]`)
        $(input).attr('name', newName)
    })

    pedido.appendTo($(".produtos"));
    pedido.find("[name$='[quantidade]']").removeAttr('aria-describedby').rules('add', { digits: true, required: true, maxlength: 6 })
    pedido.find("[name$='[desconto]']").removeAttr('aria-describedby').rules('add', { required: true })
    pedido.find("[name$='[produto_id]']").removeAttr('aria-describedby').rules('add', { required: true })


    pedido.find("[name$='[desconto]']").inputmask("decimal", {
        'alias': 'numeric',
        'groupSeparator': '',
        'autoGroup': true,
        'digits': 2,
        'radixPoint': ".",
        'digitsOptional': false,
        'allowMinus': false,
        'prefix': '',
        'suffix': ' %',
        'placeholder': '',
        'min': 0,
        'max': 100,
        'rightAlign': false,
        'removeMaskOnSubmit': true
    });
});
$(document).on('click', '.excluir-produto', function () {
    if ($('.produto').length == 2) {
        $(this).closest('.produto').remove();
        $('.excluir-produto').parent().addClass('d-none');
    } else if ($('.produto').length >= 2) {
        $(this).closest('.produto').remove();
    }
});

$(document).ready(function () {
    if ($('.produto').length >= 2) { //quando for edição e tiver mais de um produto ele mostra o boão de exclusão da produto
        $('.produto').children('.d-none').removeClass('d-none')
    }
    $(".desconto").inputmask("decimal", {
        'alias': 'numeric',
        'groupSeparator': '',
        'autoGroup': true,
        'digits': 2,
        'radixPoint': ".",
        'digitsOptional': false,
        'allowMinus': false,
        'prefix': '',
        'suffix': ' %',
        'placeholder': '',
        'min': 0,
        'max': 100,
        'rightAlign': false,
        'removeMaskOnSubmit': true,
    });
    $('#data').mask('00/00/0000');
});
